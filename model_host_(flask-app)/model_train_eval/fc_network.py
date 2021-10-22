#_________________________________________________________
#Code by Ches                                             |
#contact@ches.darkshades@gmail.com || +2349057900367      |
#_________________________________________________________|


import torch
import torch.nn as nn 


class Network(nn.Module):
    def __init__(self, input_features, output_features):

        super(Network, self).__init__()

        self.input_features = input_features
        self.output_features = output_features

        self.layer_1 = nn.Sequential(
                        nn.Linear(self.input_features, 512),
                        nn.ReLU()
                    )

        self.layer_2 = nn.Sequential(
                        nn.Linear(512, 256),
                        nn.BatchNorm1d(256),
                        nn.ReLU()
                    )

        self.layer_3 = nn.Sequential(
                        nn.Linear(256, 128),
                        nn.BatchNorm1d(128),
                        nn.ReLU()
                    )

        self.layer_4 = nn.Sequential(
                        nn.Linear(128, 64),
                        nn.BatchNorm1d(64),
                        nn.ReLU()
                    )
        
        self.layer_5 = nn.Sequential(
                        nn.Linear(64, self.output_features),
                        nn.ReLU()
                    )

    def forward(self, input):
        output = self.layer_1(input)
        output = self.layer_2(output)
        output = self.layer_3(output)
        output = self.layer_4(output)
        output = self.layer_5(output)

        return output









