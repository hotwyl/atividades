import CoursesList from './components/CoursesList.vue';
import CourseDetails from './components/CourseDetails.vue';

const routes = [
    { path: '/', component: CoursesList },
    { path: '/course/:id', component: CourseDetails, props: true }
];

export default routes;
