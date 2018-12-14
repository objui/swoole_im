new Vue({
	el:"#app",
	data:{
		username:'',
		password:''
	},
	computed: {
    
	},
	methods: {
	  	login:function(){
            _this = this;
	  		
	  		if(this.trim(this.username) == '' || this.trim(this.password) == ''){
	  		    this.$notify.error({
	                title: '错误',
	                message: '账号和密码不能为空',
	            });
	  			
	  		}else{
	  			
  
	  			axios({
				  method: 'post',
				  url: api_url+'/index/user/login',
				  data:'username='+_this.username+'&password='+_this.password,
				  headers: {
		            'Content-Type': 'application/x-www-form-urlencoded'
		         }
				}).then(function(response){
					console.log(response)
					var res = response.data;
					if(res.code == 200){
						window.sessionStorage.setItem('login_token',res.data.login_token);
						window.sessionStorage.setItem('userid',res.data.id);
						location.href='index.html';
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
