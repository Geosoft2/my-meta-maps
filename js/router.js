var Router = Backbone.Router.extend({
	routes: {
		'': 'map',
		'about': 'about',
		'help': 'help',
		'auth': 'loginout',
		'register': 'register',
		'profile': 'profile',
		'password': 'password',
		'comments/add': 'addComment',
		'geodata/:id': 'geodata'
		
	},

	about: function () {
		ContentView.register(new AboutView());
	},

	help: function () {
		ContentView.register(new HelpView());
	},

	map: function () {
		ContentView.register(new MapView());
	},

	loginout: function () {
		if (AuthUser.loggedIn) {
			userLogoutController();
		}
		else {
			new LoginView();
		}
	},

	register: function () {
		new RegisterView();
	},

	profile: function () {
		new ProfileView();
	},

	password: function () {
		new PasswordView();
	},

	addComment: function () {
		this.navigate('comments/add'); // Set correct url if not already set.
		new CommentAddViewStep1();
	},

	geodata: function (id) {
		this.navigate('geodata/' + id); // Set correct url if not already set.
		commentsToGeodataController(id);
	}

});

var router = new Router();
Backbone.history.start();
