output "manager_public_ip" {
  value = "${aws_instance.master.public_ip}"
}

output "jenkins_public_ip" {
  value = "${aws_instance.jenkins.public_ip}"
}