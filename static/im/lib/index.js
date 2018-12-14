var window_h = document.documentElement.clientHeight;
window_h = (window_h-47-40)/100;
document.getElementById('chat-msgs').style.height=window_h+"rem";
var websocket = new WebSocket(ws_server);

new Vue({
	el:"#app",
	data(){
		return {
	        fullscreenLoading: true,
	        add_menu:false,
	        msgs_list:[
	        	{
	        		id:1,
	        		src:'images/black-widow.jpg',
	        		name:'Bucky Barnes',
	        		content:'Why are you protecting me?',
	        		time:'10:15'
	        	},
	        	{
	        		id:2,
	        		src:'images/captain-america.jpg',
	        		name:'美图外卖',
	        		content:'现在下单，14点送到',
	        		time:'12:15'
	        	},
	        	{
	        		id:3,
	        		src:'images/flying-falcon.jpg',
	        		name:'Steve Rogers',
	        		content:'hello!',
	        		time:'15:15'
	        	},
	        	{
	        		id:4,
	        		src:'images/black-widow.jpg',
	        		name:'Bucky Barnes',
	        		content:'Why are you protecting me?',
	        		time:'10:15'
	        	},
	        	{
	        		id:5,
	        		src:'images/captain-america.jpg',
	        		name:'美图外卖',
	        		content:'现在下单，14点送到',
	        		time:'12:15'
	        	},
	        	{
	        		id:6,
	        		src:'images/flying-falcon.jpg',
	        		name:'Steve Rogers',
	        		content:'hello!',
	        		time:'15:15'
	        	},
	        	{
	        		id:7,
	        		src:'images/black-widow.jpg',
	        		name:'Bucky Barnes',
	        		content:'Why are you protecting me?',
	        		time:'10:15'
	        	},
	        	{
	        		id:8,
	        		src:'images/captain-america.jpg',
	        		name:'美图外卖',
	        		content:'现在下单，14点送到',
	        		time:'12:15'
	        	},
	        	{
	        		id:9,
	        		src:'images/flying-falcon.jpg',
	        		name:'Steve Rogers',
	        		content:'hello!',
	        		time:'15:15'
	        	}
	        ]
        }
	},
	
	created() {
		window.localStorage.setItem('foot_menu_selected',1);
		if(window.sessionStorage.getItem('login_token') == ''){
			location.href='index.html';
		}
		
    	setTimeout(() => {
          this.fullscreenLoading = false;
        }, 500);
	},
	mounted: function () {
		this._init();
	},
	methods: {
		_init:function(){
			let userid=window.sessionStorage.getItem('userid');
			let login_token=window.sessionStorage.getItem('login_token');
			axios({
				  method: 'post',
				  url: api_url+'/index/index/talk_list',
				  data:'userid='+userid+'&login_token='+login_token,
				  headers: {
		            'Content-Type': 'application/x-www-form-urlencoded'
		         }
				}).then(function(response){
					console.log(response)
					
				})	
				
			
			websocket.onopen = function (evt) {
				let info = {"userid":1};
				websocket.send("userid=1")
			    console.log("Connected to WebSocket server.");
			};
			
			websocket.onclose = function (evt) {
			    console.log("Disconnected");
			};
			
			websocket.onmessage = function (evt) {
			    console.log('Retrieved data from server: ' + evt.data);
			};
			
			websocket.onerror = function (evt, e) {
			    console.log('Error occured: ' + evt.data);
			};
		},
		
	  	geturl:function(url){
	  		location.href=url;
	  	},
		 handleCommand:function(url) {
	        location.href=url;
	     },
	     
	     
	  	
	  	//单个聊天
	  	send:function(id){
	  		location.href="send.html?id="+id
	  	},
	  	
	  	//过滤空格
	  	trim:function(str){  
	        return str.replace(/(^\s*)|(\s*$)/g,"");  
	    }
	}
	
})
