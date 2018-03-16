// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var app = angular.module('local', ['ionic', 'LocalStorageModule']);
var api = 'http://localhost/local/api/';
app.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
});
app.config(function($stateProvider, $urlRouterProvider,localStorageServiceProvider) {
localStorageServiceProvider.setStorageType('sessionStorage');
$stateProvider.state('login', {
    url: '/login',
    templateUrl: 'templates/login.html',
    controller: 'loginCtrl'
}).state('order', {
    url: '/order',
    templateUrl: 'templates/order.html',
    controller: 'orderCtrl'
}).state('detail', {
    url: '/detail/:id',
    templateUrl: 'templates/detail.html',
    controller: 'detailCtrl'
}).state('order-list', {
    url: '/order-list',
    templateUrl: 'templates/order-list.html',
    controller: 'orderlistCtrl'
}).state('create-order', {
    url: '/create-order',
    templateUrl: 'templates/create-order.html',
    controller: 'createorderCtrl'
});
$urlRouterProvider.otherwise('/login');

});
app.controller('loginCtrl', function($scope,$http,$ionicPopup,$state,$ionicHistory,localStorageService) {
  if (localStorageService.get('id') && localStorageService.get('role') == 15) {
    $state.go('order', {}, {location: "replace", reload: true});
  }
  if (localStorageService.get('id') && localStorageService.get('role') == 16) {
    $state.go('order-list', {}, {location: "replace", reload: true});
  }
    $scope.user = {};  //declares the object user
    $scope.login = function() {
      $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
      $http({
          method: 'POST',
          url: api+"login/check_login",
          data: { 'email' : $scope.user.email,'password' : $scope.user.password},
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function (data, status, headers, config) {
          if (data == 2) {
            var alertPopup = $ionicPopup.alert({
              title: 'Login failed!',
              template: 'Please check your credentials!'
            });
          }
          else{
            $scope.user_details = data;  // copy response values to user-details object.
            //stores the data in the session. if the user is logged in, then there is no need to show login again.
            localStorageService.set('id', $scope.user_details.id);
            localStorageService.set('role', $scope.user_details.role);
            // sessionStorage.setItem('loggedin_name', $scope.user_details.name);
            //sessionStorage.setItem('loggedin_id', $scope.user_details.id );
            if (localStorageService.get('role') == 15) {
              $state.go('order', {}, {location: "replace", reload: true});
            }
            else{
              $state.go('order-list', {}, {location: "replace", reload: true});
            }
            
          }
      }).error(function (data, status, headers, config) {
          var alertPopup = $ionicPopup.alert({
            title: 'Login failed!',
            template: 'Please check your credentials!'
          });
      });
    };
    
});
app.controller('orderCtrl', function($scope,$http,$ionicPopup,$state,$ionicHistory,localStorageService) {
  //localStorageService.remove('id');
  if (!localStorageService.get('id')) {
    $state.go('login', {}, {location: "replace", reload: true});
  }
  $scope.orders
  $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
  $http({
      method: 'GET',
      url: api+"orders/index/"+localStorageService.get('id'),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function (data, status, headers, config) {
      $scope.orders = data;
  }).error(function (data, status, headers, config) {
      console.log(data)
  });
});
app.controller('orderlistCtrl', function($scope,$http,$ionicPopup,$state,$ionicHistory,localStorageService) {
  //localStorageService.remove('id');
  if (!localStorageService.get('id')) {
    $state.go('login', {}, {location: "replace", reload: true});
  }
  $scope.orders
  $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
  $http({
      method: 'GET',
      url: api+"orders/client_order/"+localStorageService.get('id'),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function (data, status, headers, config) {
      $scope.orders = data;
  }).error(function (data, status, headers, config) {
      console.log(data)
  });
  $scope.loadform = function() {
    $state.go('create-order', {}, {location: "replace", reload: true});
  }
});
app.controller('createorderCtrl', function($scope,$http,$ionicPopup,$state,$ionicHistory,localStorageService) {
  //localStorageService.remove('id');
  $scope.item = {};
  if (!localStorageService.get('id')) {
    $state.go('login', {}, {location: "replace", reload: true});
  }
  $scope.submit = function() {
    console.log($scope.item)
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'POST',
        url: api+"orders/create_order",
        data: { 'quantity' : $scope.item.quantity,'date' : $scope.item.date,'id':localStorageService.get('id')},
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function (data, status, headers, config) {
        $state.go('order-list', {}, {location: "replace", reload: true});
    }).error(function (data, status, headers, config) {
        var alertPopup = $ionicPopup.alert({
          title: 'Submit failed!',
          template: 'Please check your internat!'
        });
    });
  };
});
app.controller('detailCtrl', function($scope,$http,$ionicPopup,$state,$ionicHistory,localStorageService) {
  //localStorageService.remove('id');
  $scope.item = {};
  if (!localStorageService.get('id')) {
    $state.go('login', {}, {location: "replace", reload: true});
  }
  var url = window.location.href
  url = url.split('/')
  var id = url[url.length - 1]
  $scope.order
  $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
  $http({
      method: 'GET',
      url: api+"orders/detail/"+id,
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function (data, status, headers, config) {
      $scope.order = data;
  }).error(function (data, status, headers, config) {
      console.log(data)
  });
  $scope.deliver = function() {
    console.log($scope.item)
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'POST',
        url: api+"orders/deliver",
        data: { 'deliver' : $scope.item.deliver,'received' : $scope.item.received,'id':id},
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function (data, status, headers, config) {
        $state.go('order', {}, {location: "replace", reload: true});
    }).error(function (data, status, headers, config) {
        var alertPopup = $ionicPopup.alert({
          title: 'Submit failed!',
          template: 'Please check your internat!'
        });
    });
  };
});