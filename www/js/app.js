var app = angular.module('local', ['ionic', 'LocalStorageModule']);
//var api = 'http://localhost/local/api/';
var api = 'http://naijabdc.com/local/api/';
var home = 0
app.run(function($state, $stateParams,$ionicPlatform) {
    $ionicPlatform.ready(function() {
        if (window.cordova && window.cordova.plugins.Keyboard) {
            cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
            cordova.plugins.Keyboard.disableScroll(true);
        }
        if (window.StatusBar) {
            StatusBar.styleDefault();
        }
    });
});
app.config(function($stateProvider, $urlRouterProvider, localStorageServiceProvider) {
    localStorageServiceProvider.setStorageType('sessionStorage');
    $stateProvider.state('login', {
            url: '/login',
            templateUrl: 'templates/login.html',
            controller: 'loginCtrl'
        }).state('main', {
            url: '/',
            templateUrl: 'templates/login.html',
            controller: 'loginCtrl'
        }).state('app.detail', {
            url: '/detail/:id',
            views: {
                'menuContent': {
                    templateUrl: 'templates/detail.html',
                    controller: 'detailCtrl'
                }
            }
        }).state('app.order-list', {
            url: '/order-list',
            views: {
                'menuContent': {
                    templateUrl: 'templates/order-list.html',
                    controller: 'orderlistCtrl'
                }
            }
        }).state('app.create-order', {
            url: '/create-order',
            views: {
                'menuContent': {
                    templateUrl: 'templates/create-order.html',
                    controller: 'createorderCtrl'
                }
            }
        }).state('app', {
            url: '/app',
            abstract: true,
            templateUrl: 'templates/menu.html',
            controller: 'AppCtrl'
        }).state('app.order', {
            url: '/order',
            views: {
                'menuContent': {
                    templateUrl: 'templates/order.html',
                    controller: 'orderCtrl'
                }
            }
        }).state('app.client', {
            url: '/client',
            views: {
                'menuContent': {
                    templateUrl: 'templates/client.html',
                    controller: 'clientCtrl'
                }
            }
        }).state('app.orderform', {
            url: '/orderform/:id',
            views: {
                'menuContent': {
                    templateUrl: 'templates/orderform.html',
                    controller: 'orderformCtrl'
                }
            }
        }).state('app.singleorder', {
            url: '/singleorder/',
            views: {
                'menuContent': {
                    templateUrl: 'templates/singleorder.html',
                    controller: 'singleorderCtrl'
                }
            }
        }).state('app.home', {
            url: '/home',
            views: {
                'menuContent': {
                    templateUrl: 'templates/home.html',
                    controller: 'homeCtrl'
                }
            }
        }).state('app.order-history', {
            url: '/order-history',
            views: {
                'menuContent': {
                    templateUrl: 'templates/order-history.html',
                    controller: 'orderhistoryCtrl'
                }
            }
        }).state('app.payment', {
            url: '/payment',
            views: {
                'menuContent': {
                    templateUrl: 'templates/payment.html',
                    controller: 'paymentCtrl'
                }
            }
        });
    $urlRouterProvider.otherwise('/login');

});
app.controller('AppCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService, $ionicSideMenuDelegate) {
    $scope.user = {}
    $scope.role = localStorageService.get('role');
    $scope.toggleLeft = function() {
        $ionicSideMenuDelegate.toggleLeft();
    };
    $scope.logout = function() {
        localStorageService.remove('id');
        localStorageService.remove('role');
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $http({
        method: 'GET',
        url: api + "users/index/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.user = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
});
app.controller('loginCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    if (localStorageService.get('id') != null) {
        $state.go('app.home', {}, {
            location: "replace",
            reload: true
        });
    }
    // if (localStorageService.get('id') != null && localStorageService.get('role') == 15) {
    //     $state.go('app.order', {}, {
    //         location: "replace",
    //         reload: true
    //     });
    // }
    // if (localStorageService.get('id') != null && localStorageService.get('role') == 16) {
    //     $state.go('app.order-list', {}, {
    //         location: "replace",
    //         reload: true
    //     });
    // }
    $scope.user = {}; //declares the object user
    $scope.login = function() {
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http({
            method: 'POST',
            url: api + "login/check_login",
            data: {
                'email': $scope.user.email,
                'password': $scope.user.password
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            if (data == 2) {
                var alertPopup = $ionicPopup.alert({
                    title: 'Login failed!',
                    template: 'Please check your credentials!'
                });
            } else {
                $scope.user_details = data; // copy response values to user-details object.
                //stores the data in the session. if the user is logged in, then there is no need to show login again.
                localStorageService.set('id', $scope.user_details.id);
                localStorageService.set('role', $scope.user_details.role);
                // sessionStorage.setItem('loggedin_name', $scope.user_details.name);
                //sessionStorage.setItem('loggedin_id', $scope.user_details.id );
                // if (localStorageService.get('role') == 15) {
                //     $state.go('app.order', {}, {
                //         location: "replace",
                //         reload: true
                //     });
                // } else {
                //     $state.go('app.order-list', {}, {
                //         location: "replace",
                //         reload: true
                //     });
                // }
                //home =0
                $state.go('app.home', {}, {
                    location: "replace",
                    reload: true
                });

            }
        }).error(function(data, status, headers, config) {
            var alertPopup = $ionicPopup.alert({
                title: 'Login failed!',
                template: 'Please check your credentials!'
            });
        });
    };

});
app.controller('homeCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {

    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    
    $scope.role = localStorageService.get('role')
    $scope.data = {}
    $http({
        method: 'GET',
        cache: false,
        url: api + "home/detail/" + localStorageService.get('id')+'/'+localStorageService.get('role'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.data = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
});
app.controller('paymentCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.history = {};
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'GET',
        cache: false,
        url: api + "orders/payment/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.history = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
});

app.controller('singleorderCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.order = localStorageService.get('order')
    console.log($scope.order)
});
app.controller('orderformCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.order
    $scope.id
    $scope.item
    setTimeout(function() {
        var url = window.location.href
        url = url.split('/')
        var id = url[url.length - 1]
        $scope.id = id
        $http({
            method: 'GET',
            cache: false,
            url: api + "orders/form/" + id +'/'+localStorageService.get('id'),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            $scope.order = data;
        }).error(function(data, status, headers, config) {
            console.log(data)
        });
    }, 300)

    $scope.deliver = function(item) {
        $scope.item = item
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http({
            method: 'POST',
            cache: false,
            url: api + "orders/submit_order",
            data: {
                'client': $scope.id,
                'rider': localStorageService.get('id'),
                'deliver': $scope.item.deliver,
                'received': $scope.item.received,
                'amount': $scope.item.amount,
                'price': ($scope.order.Price * $scope.item.deliver),
                'date': $scope.order.date
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            localStorageService.set('order', data)
            $state.go('app.singleorder', {}, {
                location: "replace",
                reload: true
            });
        }).error(function(data, status, headers, config) {
            var alertPopup = $ionicPopup.alert({
                title: 'Submit failed!',
                template: 'Please check your internat!'
            });
        });
    };
    
})
app.controller('clientCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }

    $scope.orders
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'GET',
        cache: false,
        url: api + "orders/client/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.orders = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
})
app.controller('orderCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }

    $scope.orders
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'GET',
        cache: false,
        url: api + "orders/index/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.orders = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
});
app.controller('orderhistoryCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.orders
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'GET',
        cache: false,
        url: api + "orders/history/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.orders = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
});
app.controller('orderlistCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.orders
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $http({
        method: 'GET',
        cache: false,
        url: api + "orders/client_order/" + localStorageService.get('id'),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    }).success(function(data, status, headers, config) {
        $scope.orders = data;
    }).error(function(data, status, headers, config) {
        console.log(data)
    });
    $scope.loadform = function() {
        $state.go('app.create-order', {}, {
            location: "replace",
            reload: true
        });
    }
});
app.controller('createorderCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    $scope.item = {};
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    $scope.submit = function() {
        console.log($scope.item)
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http({
            method: 'POST',
            cache: false,
            url: api + "orders/create_order",
            data: {
                'quantity': $scope.item.quantity,
                'date': $scope.item.date,
                'id': localStorageService.get('id')
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            $state.go('app.order-list', {}, {
                location: "replace",
                reload: true
            });
        }).error(function(data, status, headers, config) {
            var alertPopup = $ionicPopup.alert({
                title: 'Submit failed!',
                template: 'Please check your internat!'
            });
        });
    };
});
app.controller('detailCtrl', function($scope, $http, $ionicPopup, $state, $ionicHistory, localStorageService) {
    //localStorageService.remove('id');
    $scope.item = {};
    if (localStorageService.get('id') == null) {
        $state.go('login', {}, {
            location: "replace",
            reload: true
        });
    }
    setTimeout(function() {
        var url = window.location.href
        url = url.split('/')
        var id = url[url.length - 1]
        $scope.order
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http({
            method: 'GET',
            cache: false,
            url: api + "orders/detail/" + id,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            $scope.order = data;
        }).error(function(data, status, headers, config) {
            console.log(data)
        });
    }, 300)
    $scope.deliver = function() {
        console.log($scope.item)
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http({
            method: 'POST',
            cache: false,
            url: api + "orders/deliver",
            data: {
                'deliver': $scope.item.deliver,
                'received': $scope.item.received,
                'id': id
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data, status, headers, config) {
            $state.go('app.order', {}, {
                location: "replace",
                reload: true
            });
        }).error(function(data, status, headers, config) {
            var alertPopup = $ionicPopup.alert({
                title: 'Submit failed!',
                template: 'Please check your internat!'
            });
        });
    };
});