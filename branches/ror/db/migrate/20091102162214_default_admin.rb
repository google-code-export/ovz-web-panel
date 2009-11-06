class DefaultAdmin < ActiveRecord::Migration
  def self.up
    user = User.new
    user.login = 'admin'
    user.password = 'setup'
    user.password_confirmation = 'setup'
    user.save(false)
  end

  def self.down
    user = User.find_by_login('admin')
    user.destroy
  end
end
