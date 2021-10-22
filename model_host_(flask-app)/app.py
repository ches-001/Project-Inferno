from flask import Flask, jsonify, request
from flask_cors import CORS
import torch
from model_train_eval import fc_network


trusted_client_domain = "http://127.0.0.1:8000"
model_path = "model_train_eval/saved_model/Network(fire_archive_M6_154706).pth.tar"
in_features = 2
out_features = 1
device = "cuda" if torch.cuda.is_available == True else "cpu"

#load model
model_data = torch.load(model_path)
model = fc_network.Network(in_features, out_features)
model.load_state_dict(model_data["model_state"])
model.eval().to(device)

def model_evaluation(latitude, longitude):
    #scale data
    latitude = latitude/100
    longitude = longitude/100
    input = torch.Tensor([latitude, longitude]).unsqueeze(0).to(device)
    with torch.no_grad():
        prediction = model(input)
        prediction = prediction*100
        #celcius
        prediction = prediction-273
        return prediction.item()


app = Flask(__name__)
#The CORS is used to allow cross site request
#(accept request from a trusted client)
#The origins key specifys the truested client
CORS(app)
cors = CORS(app, resources={
    "r/*":{

    }
})

@app.route('/get_BT', methods=['GET'])
def BT_predict():
    latitude = float(request.args.get("lat"))
    longitude = float(request.args.get("long"))
    prediction = model_evaluation(latitude, longitude)

    return (jsonify(model_prediction=prediction, dtype=str(type(longitude))))

if __name__ == "__main__":
    app.run()