Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = 512
    vb.cpus = 1
  end
  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.ssh.forward_agent = true

  config.vm.define "cli", primary: true do |cli|
    cli.vm.hostname = "cli-dev"
    cli.vm.network "private_network", ip: "192.168.7.2"
    cli.vm.network "forwarded_port", guest: 5432, guest_ip: "127.0.0.1", host: 15432, host_ip: "127.0.0.1"
    cli.vm.post_up_message = "\"Click!\" command line tool environment is ready."
    cli.vm.provider "virtualbox" do |vb|
      vb.name = "click-dev"
    end
    cli.vm.provision "salt" do |salt|
      salt.install_type = "stable"
      salt.bootstrap_options = "-F -c /tmp/ -P"
      salt.no_minion = false
      salt.minion_config = "cli/minion.yml"
      salt.run_highstate = true
      salt.colorize = true
      salt.log_level = "warning"
      salt.pillar({
        "environment" => "dev",
        "install_demo" => true,
        "database" => {
          "name" => "click",
          "user" => "click_rw",
          "pass" => "click_rw_pass",
          "hba" => ["192.168.7.0/8"],
          "collate" => "C.UTF-8",
          "ctype" => "C.UTF-8",
        },
      })
    end
    cli.vm.synced_folder "cli/saltstack", "/srv"
  end

  config.vm.define "phalcon", autostart: false do |web|
    web.vm.hostname = "phalcon-dev"
    web.vm.network "private_network", ip: "192.168.7.3"
    web.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    web.vm.post_up_message = "\"Click!\" phalcon environment is ready."
    web.vm.provider "virtualbox" do |vb|
      vb.name = "phalcon-dev"
    end
    web.vm.provision "salt" do |salt|
      salt.install_type = "stable"
      salt.bootstrap_options = "-F -c /tmp/ -P"
      salt.no_minion = false
      salt.minion_config = "phalcon/minion.yml"
      salt.run_highstate = true
      salt.colorize = true
      salt.log_level = "warning"
      salt.pillar({
        "environment" => "dev",
        "database" => {
          "name" => "click",
          "user" => "click_rw",
          "pass" => "click_rw_pass",
          "host" => "dbro",
          "ip" => "192.168.7.2",
        },
      })
    end
    web.vm.synced_folder "phalcon/saltstack", "/srv"
  end
end
