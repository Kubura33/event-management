// useEventCapacity.ts
import { useEchoPublic } from "@laravel/echo-vue";
import { router } from '@inertiajs/vue3';

export function useEventCapacity(propToRefresh?: string, routeToRefresh?: string) {

    const stop = useEchoPublic(
        "events",
        "capacity.updated",
        (payload) => {
            console.log(payload)
            if(routeToRefresh && propToRefresh){
                router.visit(route(routeToRefresh), {only: [`${propToRefresh}`]})
            }
        }
    );

    return { stop };
}
