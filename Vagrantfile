Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.define "cli", primary: true do |cli|
    cli.vm.hostname = "cli-dev"
  end
end
