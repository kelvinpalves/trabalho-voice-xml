(function () {

	'use strict';

	angular
		.module('app.dashboard')
		.controller('Dashboard', Dashboard);

	Dashboard.$inject = ['$http', '$interval'];

	function Dashboard($http, $interval) {
		var vm = this;
		vm.pessoas = [];

		buscarPessoas();
		$interval(function () { buscarPessoas() }, 3000);

		function buscarPessoas() {
			$http.get('server/api.php').then(success);

			function success(response) {
				vm.pessoas = response.data;
			}
		}

	}

})();