# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT
sudo ln -s /vagrant/fuelphp/ /usr/share/nginx/www/
sudo chmod -R 777 /vagrant/fuelphp
# mysqlのモジュール（あとでChefに追加を行なう予定）
sudo apt-get install php5-mysql
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.hostname = "vagrant-fuel-berkshelf"

  config.vm.box = "ubuntu-1204"

  #config.vm.box_url = "https://dl.dropbox.com/u/31081437/Berkshelf-CentOS-6.3-x86_64-minimal.box"

  config.vm.network :private_network, ip: "33.33.33.10"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  # config.vm.synced_folder "../data", "/vagrant_data"

  #vb.customize ["modifyvm", :id, "--memory", "1024"]

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
    chef.add_recipe     "base::role"
    chef.add_recipe     "php5-fpm"
    chef.add_recipe     "fuelphp"
    chef.add_recipe    "nginx"
	# ログレベル
    #chef.log_level = :debug
  end 

  config.omnibus.chef_version = :latest
  config.vm.provision "shell", inline: $script
end
