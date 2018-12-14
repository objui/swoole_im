new Vue({
	el:"#app",
	data(){
		return {
	        fullscreenLoading: true,
	        frend_search:'',
	        frends_list:[]
	   }
	        
	},
	
	created() {
		window.localStorage.setItem('foot_menu_selected',1);
    	setTimeout(() => {
          this.fullscreenLoading = false;
        }, 500);
	},
	mounted: function () {
		
	},
	methods: {
		showfrends:function(){
			this.frends_list=[
	        	{
	        		id:1,
	        		src:'images/captain-america.jpg',
	        		name:'Bucky Barnes',
	        		email:'objui@qq.com',
	        		status:1
	        	},
	        	{
	        		id:2,
	        		src:'images/flying-falcon.jpg',
	        		name:'Tony',
	        		email:'objui@qq.com',
	        		status:0
	        	},
	        	{
	        		id:3,
	        		src:'images/black-widow.jpg',
	        		name:'Sunny',
	        		email:'objui@qq.com',
	        		status:0
	        	},
	        	{
	        		id:4,
	        		src:'images/captain-america.jpg',
	        		name:'Bucky Barnes',
	        		email:'objui@qq.com',
	        		status:0
	        	},
	        	
	        ]
		},
	  	geturl:function(url){
	  		location.href=url;
	  	},
	  	//过滤空格
	  	trim:function(str){  
	        return str.replace(/(^\s*)|(\s*$)/g,"");  
	    },
	   
	  	
	}
	
})