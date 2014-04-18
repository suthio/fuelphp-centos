#
# Cookbook Name:: php54
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

#yum_package "yum-fastestmirror" do
#  action :install
#end
package "python-software-properties" do
 action :install
end

execute "php-update" do
  user "root"
  command <<-SCRIPT
    #add-apt-repository ppa:ondrej/php5
    add-apt-repository ppa:ondrej/php5-oldstable
    apt-get update 
  SCRIPT
  action :run
end

%w(php5 php5-mysql).each do |package|
  package package do
    action :install
  end
end

execute "uninstall apache" do
  user "root"
  command <<-SCRIPT
    apt-get remove -y apache*
  SCRIPT
  action :run
end
