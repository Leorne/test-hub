import VueRouter from 'vue-router'

import TestList from './views/Tests/TestsIndex/Index'
import TestCreate from './views/Tests/TestCreate/Create'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'list',
            component: TestList
        },
        {
            path: '/test/create',
            name: 'create-test',
            component: TestCreate,
        },
    ],
});

export default router;
