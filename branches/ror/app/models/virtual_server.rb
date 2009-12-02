class VirtualServer < ActiveRecord::Base
  belongs_to :hardware_server
  belongs_to :os_template
  
  def start
    self.hardware_server.exec_command('vzctl', 'start ' + self.identity.to_s)
    self.state = 'running'
    save
  end
  
  def stop
    self.hardware_server.exec_command('vzctl', 'stop ' + self.identity.to_s)
    self.state = 'stopped'
    save
  end
  
  def restart
    self.hardware_server.exec_command('vzctl', 'restart ' + self.identity.to_s)
    self.state = 'running'
    save
  end
  
end
