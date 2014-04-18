#
# Cookbook Name:: nginx
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
execute "nginx add repo" do
  command "add-apt-repository ppa:nginx/stable;apt-get update"
  action :run
end


# パッケージ管理ツールを使ってnginxをインストールします。
package "nginx" do
  action :install
end

directory "/usr/local/nginx/logs" do
  owner "root" 
  group "root" 
  recursive true
  mode 0755
  action :create
  #not_if { File.exists "/usr/local/nginx/logs" }
end

service "nginx" do
  # nginx がサポートしている機能を教えてあげます。
  # restartとかできるよーという意味らしい。
  supports status: true, restart: true, reload: true

  # サーバーを有効にした上で、スタートします。
  # 有効にしておけばマシン再起動時にも勝手にサーバーが起動します。
  action [:enable, :start]
end

# ./site_cookbooks/templates/default/nginx.conf.erbを元にして
# nginxの設定ファイルを決まったところに置くよという指示
# Chefの規約にのおかげで置き場所のパスやテンプレートファイルは省略できている
#template "/etc/nginx/nginx.conf" do
  # ownerとgroupはrootユーザーでパーミッションは644
#  owner "root"
#  group "root"
#  mode 0644

  # この動作のあとでnginxを再起動してねという指示
#  notifies :reload, "service[nginx]"
#end
template "/etc/nginx/sites-available/default" do
  owner "root"
  owner "root"
  mode 0644

  notifies :reload, "service[nginx]"
end

