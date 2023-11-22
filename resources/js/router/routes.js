const route = [
    {
        path: "/login",
        name: 'login',
        component: () => import("../layouts/auth/viewWeb.vue"),
      
    },
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
            {
                path: "edit-request/:id",
                name: 'edit-request-user',
                component: () => import("../layouts/page/user/editRequest.vue"),
            },
            {
                path: "request-member",
                name: 'request-member',
                component: () => import("../layouts/page/user/reqMember.vue"),
            },

        ]
    },
    
    {
        path: "/admin-hcm",
        name: 'admin-h',
        component: () => import("../layouts/page/admin-hcm/admin.vue"),
        children:[
            {
                path: "",
                name: 'admin-calendar',
                component: () => import("../layouts/page/calendar/calendar.vue"),
            },
            {
                path: "",
                name: 'admin-hcm-list-user',
                component: () => import("../layouts/page/systemAdmin/user/list.vue"),
            },
            {
                path: "statistical",
                name: 'statistical-hcm',
                component: () => import("../layouts/page/admin-hcm/statistical.vue"),
              
            },
            {
                path: "product",
                name: 'product',
                component: () => import("../layouts/page/admin-hcm/product.vue"),
             
            },
            {
                path: "category",
                name: 'category',
                component: () => import("../layouts/page/admin-hcm/category.vue"),
             
            },
            {
                path: "category/view",
                name: 'view-category',
                component: () => import("../layouts/page/admin-hcm/categoryView.vue"),
             
            },
            {
                path: "product/add",
                name: 'product-add',
                component: () => import("../layouts/page/admin-hcm/addProduct.vue"),
             
            },
            {
                path: "product/import",
                name: 'import-product',
                component: () => import("../layouts/page/admin-hcm/importProduct.vue"),
             
            },
            {
                path: "product/view/:id",
                name: 'view-product',
                component: () => import("../layouts/page/admin-hcm/viewProduct.vue"),
             
            },
            {
                path: "product/edit/:id",
                name: 'edit-product',
                component: () => import("../layouts/page/admin-hcm/editProduct.vue"),
             
            },
            {
                path: "profile",
                name: 'user-proflie',
                component: () => import("../layouts/page/admin-hcm/profile.vue"),
            },
            {
                path: "edit/:id",
                name: 'sys-edit-user',
                component: () => import("../components/editUser.vue"),
            },
            {
                path: "view/:id",
                name: 'sys-user-view',
                component: () => import("../layouts/page/admin-hcm/profile.vue"),
                
            },
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
            {
                path: "booking",
                name: 'sys-booking',
                component: () => import("../layouts/page/admin-hcm/listImBook.vue"),
            }
        ],
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
                    
        
                    
                    
                   
                ]
            },
            {
                path: "admin-hcm",
                name: 'admin-hcm',
                component: () => import("../layouts/page/admin-hcm/admin.vue"),
                children:[
                    
                    // {
                    //     path: "calendar",
                    //     name: 'calendar',
                    //     component: () => import("../layouts/page/calendar/view.vue"),
                     
                    // },
                ]
            },
            {
                path: "",
                name: 'sys-calendar-view',
                component: () => import("../layouts/page/calendar/view.vue"),
                children:[
                   
                ]
             
            },
            
        ]
      
    },
    

    ];

export default route;
