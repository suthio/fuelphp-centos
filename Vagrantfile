# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT
sudo ln -s /vagrant/fuelphp/ /usr/share/nginx/html/
sudo chmod -R 777 /vagrant/fuelphp
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.hostname = "vagrant-fuel-berkshelf"
  config.vm.box = "centos64_ja"
  config.vm.box_url = "https://dl.dropboxusercontent.com/u/3657281/centos64_ja.box"
  config.vbguest.auto_update = false
  #config.vm.box = "ubuntu-1204"
  #config.vm.box_url = "http://cloud-images.ubuntu.com/vagrant/precise/current/precise-server-cloudimg-i386-vagrant-disk1.box"
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end
  config.vm.network :private_network, ip: "33.33.33.10"
  #config.vm.network "forwarded_port", guest: 80, host: 8080
  # config.vm.synced_folder "../data", "/vagrant_data"
  #config.vm.synced_folder "./", "/vagrant" 
  #vb.customize ["modifyvm", :id, "--memory", "1024"]
  config.vbguest.auto_update = true 
  #config.ssh.max_tries = 40
  #config.ssh.timeout   = 120

  #config.berkshelf.enabled = true

  config.vm.provision :chef_solo do |chef|
    chef.json = {
      :mysql => {
        :server_root_password => 'rootpass',
        :server_debian_password => 'debpass',
        :server_repl_password => 'replpass'
      },
      :nginx => {
        :port => 80
      }
    }
    # Chefを実行
    chef.cookbooks_path = ["./site-cookbooks","./cookbooks"]
    #chef.add_recipe     "base::role"
    #chef.add_recipe     "php5"
    chef.add_recipe     "php54"
    chef.add_recipe     "php5-fpm"
    chef.add_recipe     "fuelphp"
    chef.add_recipe    "nginx"
	# ログレベル
    #chef.log_level = :debug
  end 

  config.omnibus.chef_version = :latest
  config.vm.provision "shell", inline: $script
  config.vm.provision :serverspec do |spec|
    spec.pattern = 'spec/*_spec.rb'
  end
end
