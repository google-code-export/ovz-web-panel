class HardwareServer < ActiveRecord::Base
  attr_accessible :host, :auth_key, :description
  
  validates_uniqueness_of :host
  
  def connect
    save
  end
  
  def disconnect
    destroy
  end
  
end
