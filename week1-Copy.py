import numpy
import urllib
import scipy.optimize
import random
X = []
Y = []
for edge in  open("analysis.txt"):
  x,y = edge.split()
  X.append(int(x))
  Y.append(y)



def feature(datum):
  feat = [1]
  return feat
feature = []
for i in Y:
	feature.append([1, int(i), int(i)**2])
print feature
theta,residuals,rank,s = numpy.linalg.lstsq(feature, X)
print theta
print residuals

print rank

print s


