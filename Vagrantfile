# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.synced_folder ".", "/var/www/interstellar.dev", type:"nfs"
  config.vm.host_name = "interstellar.dev"
  config.vm.network "private_network", ip: "192.168.66.15"
  config.vm.network "forwarded_port", guest: 3000, host: 3000
  config.vm.network "forwarded_port", guest: 27017, host: 27017
  config.ssh.forward_x11 = true

  config.vm.provider "virtualbox" do |v|
      v.name = "interstellar.dev"
      v.memory = 4096
      v.cpus = 2
  end

  config.vm.provision "ansible" do |ansible|
      ansible.playbook = "provisioning/playbook.yml"
      ansible.inventory_path = "inventory.ini"
      ansible.extra_vars = { ansible_ssh_user: 'vagrant' }
      ansible.limit = "all"
  end

end
