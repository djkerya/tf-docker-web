provider "aws" {
    access_key = "${var.aws_access_key}"
    secret_key = "${var.aws_secret_key}"
    region = "${var.aws_region}"
}

#provider "docker" {
#    host = "tcp://${aws_instance.master.public_ip}:2376/"
#}