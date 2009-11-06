class SessionsController < ApplicationController

  def new
  end

  def create
    logout_keeping_session!
    user = User.authenticate(params[:login], params[:password])
    if user
      self.current_user = user
      new_cookie_flag = (params[:remember_me] == "1")
      handle_remember_cookie! new_cookie_flag
      render :json => { :success => true }  
    else
      logger.warn "Failed login for '#{params[:login]}' from #{request.remote_ip} at #{Time.now.utc}"
      render :json => { :success => false, :message => "Invalid login/password." } 
    end
  end

  def destroy
    logout_killing_session!
    redirect_back_or_default('/')
  end

end
