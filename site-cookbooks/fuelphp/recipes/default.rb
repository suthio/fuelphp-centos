#
# Cookbook Name:: fuelphp
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

%w(git curl).each do |package|
  package package do
    action :install
  end
end

execute "fuelphp install" do
  user "root"
  command <<-EOH
    curl get.fuelphp.com/oil | sh
  EOH
  action :run
end

