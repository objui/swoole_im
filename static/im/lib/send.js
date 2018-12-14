var window_h = document.documentElement.clientHeight;
window_h = (window_h-47-40)/100;
document.getElementById('send-msgs').style.height=window_h+"rem";


new Vue({
	el:"#app",
	data(){
		return {
	        fullscreenLoading: true,
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
	  	
	  	geturl:function(url){
	  		location.href=url;
	  	},
	  	//过滤空格
	  	trim:function(str){  
	        return str.replace(/(^\s*)|(\s*$)/g,"");  
	    }
	}
	
})