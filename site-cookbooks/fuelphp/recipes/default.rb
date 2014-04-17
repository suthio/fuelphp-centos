#
# Cookbook Name:: fuelphp
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
execute "fuelphp install" do
  user "root"
  command <<-EOH
    curl get.fuelphp.com/oil | sh
  EOH
  action :run
end

