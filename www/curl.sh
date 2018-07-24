curl --unix-socket /var/run/docker.sock -v --output -  \
http:/v1.37/containers/1955df196d83e27f1d78413f58f797762c4f5c7a894f1a6573828f31c46d2f6a/logs?stdout=1


#1955df196d83e27f1d78413f58f797762c4f5c7a894f1a6573828f31c46d2f6a/logs/json


#curl --unix-socket /var/run/docker.sock -v -X POST -H "Content-Type: application/json" -d `{"Privileged":flse}' \
#http:/containers/1955df196d83e27f1d78413f58f797762c4f5c7a894f1a6573828f31c46d2f6a/logs
