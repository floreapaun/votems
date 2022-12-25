#!/usr/bin/env python
from sklearn.model_selection import train_test_split
from keras.models import load_model
from keras.models import Sequential
from keras.layers.core import Dense, Activation
import os
import pandas as pd
import io
import numpy as np
from sklearn import metrics
import numpy as np
from sklearn import metrics
from keras.callbacks import EarlyStopping
from keras.callbacks import ModelCheckpoint
import matplotlib.pyplot as plt

import sys
import json

path = 'G:\\Programs\\xampp\\htdocs\\pollvot\\cgi-bin'
filename_read = os.path.join(path,"dvotes.csv")

# load model
model = load_model(os.path.join(path, 'model.h5'))

#read the content inside a DataFrame object
df = pd.read_csv(filename_read,na_values=['NA','?'])

#dataset is an object of type numpy.ndarray
dataset=df.values
x=dataset[:,[0, 1, 2, 3, 4, 5, 6]] 
y=dataset[:,7] 

arr = np.arange(7)

for i in range(1, len(sys.argv)):
    arr[i-1] = sys.argv[i]

a = np.array([arr])
pred = model.predict(a, verbose=0)

for x in np.nditer(pred):
    val = x
arr = val.ravel()

sys.stdout.write(json.dumps(int(round(arr[0].item()))) )
sys.stdout.close()

