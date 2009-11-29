class VirtualServer < ActiveRecord::Base
  belongs_to :hardware_server
  belongs_to :os_template
end
