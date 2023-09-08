const route = [
    {
        path: "/home",
        name: 'home',
        component: () => import("../layouts/page/home/home.vue"),
        children:[
            {
                path: "test",
                name: 'test',
                component: () => import("../layouts/page/user/profile.vue"),
            },
        ]
    },
    {
        path: "/user",
        name: 'ca',
        component: () => import("../layouts/page/user/calendar.vue"),
        children:[
            {
                path: "",
                name: 'user-calendar',
                component: () => import("../layouts/page/calendar/calendar.vue"),
            },
            {
                path: "createReq",
                name: 'createReq-user',
                component: () => import("../layouts/page/user/createReq.vue"),
            },
            {
                path: "request",
                name: 'request-user',
                component: () => import("../layouts/page/user/request.vue"),
            },
            {
                path: "view-request/:id",
                name: 'view-request-user',
                component: () => import("../layouts/page/user/viewRequest.vue"),
            },

        ]
    },
    {
        path: "/login",
        name: 'login',
        component: () => import("../layouts/auth/viewWeb.vue"),
      
    },
    {
        path: "/admin-hcm",
        name: 'admin-h',
        component: () => import("../layouts/page/admin/admin.vue"),
        children:[
            {
                path: "statistical",
                name: 'statistical',
                component: () => import("../layouts/page/admin/statistical.vue"),
              
            },
            {
                path: "calendar",
                name: 'calendar',
                component: () => import("../layouts/page/calendar/view.vue"),
             
            },
        ]
      
    },
    {
        path: "/admin-dn",
        name: 'admin-d',
        component: () => import("../layouts/page/admin/admin.vue"),
        children:[
            {
                path: "statistical",
                name: 'statistical',
                component: () => import("../layouts/page/admin/statistical.vue"),
              
            },
            {
                path: "calendar",
                name: 'calendar',
                component: () => import("../layouts/page/calendar/view.vue"),
             
            },
        ]
      
    },
    {
        path: "/system",
        name: 'sys',
        component: () => import("../layouts/page/systemAdmin/view.vue"),
        children:[
            {
                path: "user",
                name: 'sys-user',
                component: () => import("../layouts/page/systemAdmin/user/manager.vue"),
                children:[
                    {
                        path: "",
                        name: 'view-user',
                        component: () => import("../layouts/page/systemAdmin/user/list.vue"),
                    }
                    ,
                    {
                        path: "pro",
                        name: 'test-sys',
                        component: () => import("../layouts/page/user/profile.vue"),
                    },
                    {
                        path: "view/:id",
                        name: 'sys-user-view',
                        component: () => import("../layouts/page/systemAdmin/user/profile.vue"),
                    }
                    ,
                    {
                        path: "edit/:id",
                        name: 'sys-edit-user',
                        component: () => import("../components/editUser.vue"),
                    }
                    
                   
                ]
            },
            {
                path: "statistical",
                name: 'statistical',
                component: () => import("../layouts/page/admin/statistical.vue"),
            },
            {
                path: "admin-dn",
                name: 'admin-dn',
                component: () => import("../layouts/page/admin/admin.vue"),
                children:[
                    {
                        path: "statistical",
                        name: 'statistical',
                        component: () => import("../layouts/page/admin/statistical.vue"),
                      
                    },
                    {
                        path: "calendar",
                        name: 'calendar',
                        component: () => import("../layouts/page/calendar/view.vue"),
                    },
                ]
              
            },
            {
                path: "admin-hcm",
                name: 'admin-hcm',
                component: () => import("../layouts/page/admin/admin.vue"),
                children:[
                    {
                        path: "statistical",
                        name: 'statistical',
                        component: () => import("../layouts/page/admin/statistical.vue"),
                      
                    },
                    // {
                    //     path: "calendar",
                    //     name: 'calendar',
                    //     component: () => import("../layouts/page/calendar/view.vue"),
                     
                    // },
                ]
            },
            {
                path: "calendar",
                name: 'sys-calendar-view',
                component: () => import("../layouts/page/calendar/view.vue"),
                children:[
                   
                    {
                        path: "",
                        name: 'sys-calendar',
                        component: () => import("../layouts/page/calendar/calendar.vue"),
                    },
                    {
                        path: "holiday",
                        name: 'sys-holiday',
                        component: () => import("../layouts/page/calendar/holiday.vue"),
                    },
                    {
                        path: "view/:id",
                        name: 'sys-holidayview',
                        component: () => import("../layouts/page/calendar/holidayView.vue"),
                    },
                    {
                        path: "createHld",
                        name: 'sys-createHld',
                        component: () => import("../layouts/page/calendar/createHld.vue"),
                    },
                ]
             
            },
            
        ]
      
    },
    

    ];

export default route;
