resource "aws_key_pair" "default"{
  key_name = "kirill-ivanov"
  public_key = "${file("${var.key_path}")}"
}

resource "aws_instance" "master" {
  ami = "${var.ami}"
  instance_type = "${var.instance_type}"
  key_name = "${aws_key_pair.default.id}"
  user_data = "${file("${var.bootstrap_path}")}"
  vpc_security_group_ids = ["${aws_security_group.default.id}"]
  associate_public_ip_address = "true"

  tags {
    Name  = "kirill-ivanov master"
  }

  connection = {
    user = "ubuntu"
  }

  provisioner "file" {
    source      = "nginx.conf"
    destination = "/home/ubuntu/nginx.conf"
  }

#  provisioner "remote-exec" {
#    inline = [
#      "apt-get install -y jq"
#    ]
# }

  provisioner "remote-exec" {
    script = "install-docker.sh"
  }

  provisioner "file" {
    source      = "www/index.php"
    destination = "/home/ubuntu/www/index.php"
  }

  provisioner "remote-exec" {
    inline = [
      "docker swarm init --advertise-addr ${aws_instance.master.public_ip}"
    ]
  }

  provisioner "remote-exec" {
    inline = [
      "docker service create --name registry --publish published=5000,target=5000 registry:2"
    ]
    inline = [
      "docker-compose push"
    ]
    inline = [
      "docker stack deploy  --orchestrator swarm  --compose-file docker-compose.yml www"
    ]


}

resource "aws_instance" "worker1" {
  ami = "${var.ami}"
  instance_type = "${var.instance_type}"
  key_name = "${aws_key_pair.default.id}"
  user_data = "${file("${var.bootstrap_path}")}"
  vpc_security_group_ids = ["${aws_security_group.default.id}"]

  tags {
    Name  = "kirill-ivanov worker"
  }

  connection = {
    user= "ubuntu"
  }

  provisioner "file" {
    source      = "nginx.conf"
    destination = "/home/ubuntu/nginx.conf"
  }

  provisioner "remote-exec" {
    script = "install-docker.sh"
  }

  provisioner "file" {
    source      = "www/index.php"
    destination = "/home/ubuntu/www/index.php"
  }

  provisioner "remote-exec" {
    inline = [
      "docker swarm join --token ${data.external.swarm_join_token.result.worker} ${aws_instance.master.public_ip}:2377"
    ]
  }


}


resource "aws_instance" "jenkins" {
  ami = "${var.ami}"
  instance_type = "${var.instance_type}"
  key_name = "${aws_key_pair.default.id}"
  user_data = "${file("${var.bootstrap_path}")}"
  vpc_security_group_ids = ["${aws_security_group.default.id}"]

  tags {
    Name  = "kirill-ivanov jenkins"
  }

  connection = {
    user = "ubuntu"
  }

  provisioner "remote-exec" {
    script = "install-jenkins.sh"
  }

#  provisioner "remote-exec" {
#    inline = [
#      "service jenkins restart"
#    ]
#  }


}

# configure nginx image
#resource "docker_image" "nginx" {
#  name = "nginx:latest"
#}

# Create an Nginx container
#resource "docker_container" "nginx" {
#  image = "${docker_image.nginx.latest}"
#  name  = "nginx-server"
#  ports {
#    internal = 80
#    external = 80
#  }
#  volumes {
#    container_path  = "/usr/share/nginx/html"
#    host_path = "/home/test/www"
#    read_only = true
#  }
#}

data "external" "swarm_join_token" {
  program = ["./get-join-tokens.sh"]
  query = {
    host = "${aws_instance.master.public_ip}"
    user = "ubuntu"
  }
}
