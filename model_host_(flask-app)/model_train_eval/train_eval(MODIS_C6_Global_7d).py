#_________________________________________________________
#Code by Ches                                             |
#contact@ches.darkshades@gmail.com || +2349057900367      |
#_________________________________________________________|


import torch, fc_network, os
import torch.nn as nn
import torch.optim as optim
import pandas as pd 
from tqdm import tqdm
import numpy as np
import matplotlib.pyplot as plt 
from sklearn.model_selection import train_test_split as tts 
from sklearn.svm import SVR


#dataloader
data_path = "data/fire_archive_M6_154706.csv"
test_size = 0.0002 # 20% of data
epochs = 50
in_features = 2
out_features = 1
lr = 0.01
batch_size = 100
model_path = "saved_model/Network(fire_archive_M6_154706).pth.tar"


def dataloader(data_path = data_path):
    data = pd.read_csv(data_path)
    features_col = ['latitude', 'longitude']
    X = data[features_col].values.reshape(-1, 2)/100
    Y = data['brightness'].values.reshape(-1, 1)/100

    return (X, Y)


def save_model(model, path = model_path):
    print('saving model >>>>>>>>>>>')
    torch.save(model, path)
    print('saved model successfully >>>>>>>>>>>')


#data splicer
def data_splicing(data = dataloader(), test_size = test_size):
    X_train, X_eval, Y_train, Y_eval = tts(data[0], data[1], test_size=test_size, random_state=5, shuffle=True)
    X_train, X_eval, Y_train, Y_eval = (torch.Tensor(X_train), torch.Tensor(X_eval),
                                        torch.Tensor(Y_train), torch.Tensor(Y_eval)
                                    )
    return (X_train, Y_train, X_eval, Y_eval)
 

#weight init
def __init_weight__(m):
    classname = m.__class__.__name__
    if classname.find('Linear') != -1:
        m.weight.data.uniform_(-0.08, 0.08)
        m.bias.data.fill_(0)


Network = fc_network.Network(in_features, out_features)
Network.apply(__init_weight__)

optimizer = optim.Adam(Network.parameters(), lr = lr)
scheduler = optim.lr_scheduler.ExponentialLR(optimizer, gamma=0.9, last_epoch=-1)
criterion = nn.SmoothL1Loss()


#visualize loss_vs_epoch trend
def visualize(loss, epoch):
    plt.style.use('bmh')
    plt.title('loss vs epoch')
    plt.plot(loss, epoch)
    plt.xlabel('epoch')
    plt.ylabel('loss')
    plt.show()


def accuracy(pred, actual):
    lossfunc = nn.L1Loss()
    errors = []
    accuracy = []
    for x, y in zip(pred, actual):
        errors.append(lossfunc(torch.Tensor([x]), torch.Tensor([y])).item())
    for error, actual in zip(errors, actual):
        accuracy.append((100-(error / actual) * 100))
    return np.mean(accuracy)


def svm_train(data = data_splicing()):
    model = SVR(kernel='linear')
    model.fit(data[0], data[1].reshape(-1))
    pred = model.predict(data[2])
    pred = pred * 100
    actual = data[3] * 100
    comparism_data_frame = pd.DataFrame({'actual':actual.flatten(), 'predicted':pred.flatten()})
    mean_accuracy = accuracy(pred, actual.reshape(-1))
    print(f'mean accuracy of : {mean_accuracy}%')
    print(comparism_data_frame)
    comparism_data_frame.head(15).plot(kind='bar')
    plt.grid(which='major', linestyle='-', linewidth=0.5, color='green')
    plt.grid(which='minor', linestyle=':', linewidth=0.5, color='black')
    plt.show()


#train_process
def train_process(data = data_splicing(),  epochs = epochs, batch_size = batch_size):
    if not os.path.isfile(model_path):
        X = data[0]
        Y = data[1]
        epoch_axis = np.array([])
        trainLoss = np.array([])
        evalLoss = np.array([])
        LOSS = np.array([])

        for epoch in range(epochs):
            print(f'epoch: {epoch+1}')
            epoch_axis = np.append(epoch_axis, epoch)
            for batch in tqdm(range(0, len(X), batch_size)):
                Network.zero_grad()
                batch_X = X[batch:batch + batch_size]
                Network.train()
                output = Network(batch_X)
                loss = criterion(output, Y[batch:batch + batch_size])
                loss.backward()
                optimizer.step()
                LOSS = np.append(LOSS, loss.item())
            scheduler.step()

            #evaluate
            Network.eval()
            eval_out = Network(data[2])
            eval_loss = criterion(eval_out, data[3])
            evalLoss = np.append(evalLoss, eval_loss.item())

            if (epoch+1) % 2 == 0:
                model_state = {'model_state':Network.state_dict(),
                            'lossFunc':criterion.state_dict(),
                            'optimizer':optimizer.state_dict()
                        }
                save_model(model_state)

            trainLoss = np.append(trainLoss, np.mean(LOSS))
            print(f'epoch:{epoch+1} \t train_loss:{np.mean(LOSS)} \t eval_loss:{eval_loss}')
            LOSS = np.array([])

        visualize(loss=trainLoss, epoch=epoch_axis)
        visualize(loss=evalLoss, epoch=epoch_axis)
    else:
        pass


#evaluate the model on out of saple data after training
def evaluation(data = data_splicing()):
    eval_X = data[2]
    print(eval_X)
    #denormalize targets
    eval_Y = data[3].numpy()*100

    #load model
    model_state = torch.load(model_path)
    Network_model = fc_network.Network(in_features, out_features)
    Network_model.load_state_dict(model_state['model_state'])
    Network_model.eval()

    with torch.no_grad():
        prediction = Network_model(eval_X)
        loss = criterion(prediction*100, torch.Tensor(eval_Y))
        print(f"eval_loss is :{loss} \n")
        #denormalize
        prediction  = np.array(prediction.detach())
        mean_accuracy = accuracy(prediction*100, eval_Y)
        print(f'mean accuracy of: {mean_accuracy}%')

        comparism_data_frame = pd.DataFrame()
        comparism_data_frame['actual'] = eval_Y.reshape(-1)
        comparism_data_frame['predicted'] = prediction.reshape(-1)*100
        print(comparism_data_frame)

        comparism_data_frame.head(15).plot(kind='bar')
        plt.grid(which='major', linestyle='-', linewidth=0.5, color='green')
        plt.grid(which='minor', linestyle=':', linewidth=0.5, color='black')
        plt.show()


train_process()
evaluation()
#svm_train()