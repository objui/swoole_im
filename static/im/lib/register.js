new Vue({
	el:"#app",
	data:{
		username:'',
		password:'',
		repassword:'',
		error:''
	},
	computed: {
    
	},
	methods: {
	  	register:function(){
	  		console.log(this.trim(this.password)+'|'+this.trim(this.repassword))
            _this = this;
	  		this.error = '';
	  		if(this.trim(this.username) == '' || this.trim(this.password) == ''  || this.trim(this.repassword) == ''){
	  		    _this.$notify.error({
	                title: '错误',
	                message: '请完整输入注册信息',
	            });
	  		}else if(this.trim(this.password) != this.trim(this.repassword)){
	  			_this.$notify.error({
	                title: '错误',
	                message: '2次输入的密码不一致',
	            });
	  		}else{
	  			
  
	  			axios({
				  method: 'post',
				  url: api_url+'/index/user/register',
				  data:'username='+_this.username+'&password='+_this.password+'&repassword='+_this.repassword,
				  headers: {
		            'Content-Type': 'application/x-www-form-urlencoded'
		         }
				}).then(function(response){
					console.log(response)
					var res = response.data;
					if(res.code == 200){
						_this.$notify({
				          title: '成功',
				          message: '恭喜，注册成功！',
				          type: 'success',
				          onClose:function(){
				          	location.href='login.html';
				          }
				       });
						
					}else{
						_this.$notify.error({
			                title: '错误',
			                message: res.msg,
			            });
					}
				})	
	  			
	  			
            }            
	  	},
	  	
	  	//过滤空格
	  	trim:function(str){  
	        return str.replace(/(^\s*)|(\s*$)/g,"");  
	    }
	}
	
})
