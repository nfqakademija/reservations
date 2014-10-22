Vagrant.require_version ">= 1.5"

require 'yaml'

server = YAML.load_file(File.join(File.dirname(File.expand_path(__FILE__)), ".vagrant", "config.yml"))

Vagrant.configure("2") do |config|
  config.vm.box = server['vm']['box']
  config.vm.box_url = server['vm']['box_url']
  config.vm.hostname = server['vm']['hostname']
  config.hostsupdater.aliases = server['vm']['hostnames']
  config.ssh.forward_agent = true

  config.vm.network "private_network", ip: server['vm']['network']['private_network']
  config.vm.network :forwarded_port, guest: server['vm']['network']['guest_port'], host: server['vm']['network']['host_port']

  config.vm.synced_folder server['vm']['sync']['source'], server['vm']['sync']['target'], id: "vagrant-root", type: "nfs"

  config.vm.usable_port_range = (10200..10500)

  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--memory", server['vm']['memory']]
    v.customize ["modifyvm", :id, "--cpus", server['vm']['cpu']]
    v.customize ["modifyvm", :id, "--name", server['vm']['hostname']]
  end

  config.vm.provision :shell, :path => ".vagrant/librarian.sh"
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = ".vagrant/manifests"
    puppet.options = ["--verbose", "--parser future"]
  end
end
