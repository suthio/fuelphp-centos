#
# Cookbook Name:: php5-fpm
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

package 'php5-fpm' do
  action :install
end
# apacheの起動 CentOSの場合
service "php5-fpm"do
    action [:start, :enable]
end

service "php5-fpm" do
  supports :status => true, :restart => true, :reload => true
end
