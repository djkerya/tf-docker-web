variable "aws_region" {
  description = "AWS region on which we will setup the swarm cluster"
  default = "eu-west-1"
}

variable "ami" {
  description = "Amazon Linux AMI"
# 18.04 eu-west-1
#    default = "ami-d2414e38"
# 16.04 eu-west-1
    default = "ami-2a7d75c0"
}

variable "instance_type" {
  description = "Instance type"
  default = "t2.micro"
}

variable "key_path" {
  description = "SSH Public Key path"
  default = "/home/kerya/.ssh/id_rsa.pub"
}

variable "bootstrap_path" {
  description = "Script to install Docker Engine"
  default = "install-docker.sh"
}

