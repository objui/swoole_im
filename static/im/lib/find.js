var window_h = document.documentElement.clientHeight;
window_h = (window_h-47-40)/100;
document.getElementById('find-list').style.height=window_h+"rem";


new Vue({
	el:"#app",
	data(){
		return {
	        fullscreenLoading: true,
	        frend_search:'联系人搜索',
	        frends_list:[
	        	{
	        		id:1,
	        		src:'images/captain-america.jpg',
	        		name:'Bucky Barnes',
	        		email:'objui@qq.com'
	        	},
	        	{
	        		id:2,
	        		src:'images/flying-falcon.jpg',
	        		name:'Tony',
	        		email:'objui@qq.com'
	        	},
	        	{
	        		id:3,
	        		src:'images/black-widow.jpg',
	        		name:'Sunny',
	        		email:'objui@qq.com'
	        	},
	        ]
        }
	},
	
	created() {
		window.localStorage.setItem('foot_menu_selected',3);
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
	  	
	  	//单个聊天
	  	edit:function(id){
	  		location.href="frend_edit.html?id="+id
	  	},
	  	
	  	//过滤空格
	  	trim:function(str){  
	        return str.replace(/(^\s*)|(\s*$)/g,"");  
	    }
	}
	
})