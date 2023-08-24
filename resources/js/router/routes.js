const route = [
    {
        path: "/home",
        name: 'home',
        component: () => import("../layouts/page/home/home.vue"),
       
    },
    {
        path: "/calendar",
        name: 'calendar',
        component: () => import("../layouts/page/calendar/calendar.vue"),
        children:[
            
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
                    {
                        path: "calendar",
                        name: 'calendar',
                        component: () => import("../layouts/page/calendar/view.vue"),
                     
                    },
                ]
              
            },
            {
                path: "calendar",
                name: 'calendar',
                component: () => import("../layouts/page/calendar/view.vue"),
                children:[
                   
                    {
                        path: "",
                        name: 'calendars',
                        component: () => import("../layouts/page/calendar/calendar.vue"),
                     
                    },
                    {
                        path: "holiday",
                        name: 'holiday',
                        component: () => import("../layouts/page/calendar/holiday.vue"),
                    },
                    {
                        path: "view/:id",
                        name: 'holidayview',
                        component: () => import("../layouts/page/calendar/holidayView.vue"),
                    },
                    {
                        path: "createHld",
                        name: 'createHld',
                        component: () => import("../layouts/page/calendar/createHld.vue"),
                      
                    },
                    {
                        path: "createReq",
                        name: 'createReq',
                        component: () => import("../layouts/page/calendar/createReq.vue"),
                      
                    },
                    {
                        path: "request",
                        name: 'request',
                        component: () => import("../layouts/page/calendar/request.vue"),
                      
                    },
                ]
             
            },
        ]
      
    },
    

    ];

export default route;
