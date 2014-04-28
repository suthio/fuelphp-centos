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
if platform?("ubuntu","debian")
  package "python-software-properties" do
   action :install
  end
end

if platform?("ubuntu","debian")
  execute "php-update" do
    user "root"
    command <<-SCRIPT
      #add-apt-repository ppa:ondrej/php5
      add-apt-repository ppa:ondrej/php5-oldstable
      apt-get update
    SCRIPT
    action :run
  end
end

if platform?("redhat", "centos", "fedora")
  execute "yum-repo" do
  user "root"
  command <<-SCRIPT
    rpm -ivh http://ftp.riken.jp/Linux/fedora/epel/6/i386/epel-release-6-8.noarch.rpm
    rpm -ivh http://dl.iuscommunity.org/pub/ius/stable/CentOS/6/x86_64/ius-release-1.0-11.ius.centos6.noarch.rpm
    yum -y update
  SCRIPT
  end
end

if platform?("redhat", "centos", "fedora")
  %w(php54 php54-cli php54-pdo php54-mbstring php54-mcrypt php54-pecl-memcache php54-mysql php54-devel php54-common php54-pgsql php54-pear php54-gd php54-xml php54-pecl-xdebug php54-pecl-apc).each do |package|
    yum_package package do
      action :install
    end
  end
end

if platform?("ubuntu","debian")
  execute "uninstall apache" do
    user "root"
    command <<-SCRIPT
      apt-get remove -y apache*
    SCRIPT
    action :run
  end
end

if platform?("centos")
  execute "uninstall apache" do
    user "root"
    command <<-SCRIPT
      yum remove -y apache*
    SCRIPT
    action :run
  end
end
