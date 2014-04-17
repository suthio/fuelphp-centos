# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.hostname = "vagrant-fuel-berkshelf"

  config.vm.box = "ubuntu-1204"

  #config.vm.box_url = "https://dl.dropbox.com/u/31081437/Berkshelf-CentOS-6.3-x86_64-minimal.box"

  #config.vm.network :private_network, ip: "33.33.33.10"

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
      }
    }
    # Chefを実行
    chef.cookbooks_path = ["./site-cookbooks","./cookbooks"]
    chef.add_recipe     "base::role"
    #chef.add_recipe    "apt"
    #chef.add_recipe    "nginx"
    #chef.add_recipe    "apt"
    #chef.add_recipe    "mysql"
    #chef.add_recipe    "php"
	# ログレベル
    #chef.log_level = :debug
  end 

  config.omnibus.chef_version = :latest
end
