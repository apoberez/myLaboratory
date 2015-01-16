# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.synced_folder ".", "/var/www/interstellar.dev"
  config.vm.host_name = "interstellar.dev"

  config.vm.provision "ansible" do |ansible|
      ansible.playbook = "provisioning/playbook.yml"
      ansible.inventory_path = "inventory.ini"
      ansible.limit = "all"
  end

end
