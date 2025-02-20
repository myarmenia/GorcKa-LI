import { usePage } from '@inertiajs/vue3';

// export function useTrans(value) {
//     const array = usePage().props.translations;
//     array[value] != null ? array[value] : value;
//     console.log(array['page']['title'], ' ***********')
//     // return array[value] != null ? array[value] : value;
// }


// export function useTrans(value) {
//     const array = usePage().props.translations;

//     return value.split('.').reduce((t, k) => t?.[k] ?? value, array);
// }
export function useTrans(value) {
    if (typeof value !== 'string') {
        console.error('useTrans received an invalid value:', value);
        return value; // Return the original value if it's not a string
    }

    const array = usePage().props.translations || {}; // Ensure translations exist
console.log(value,'444444')
    return value.split('.').reduce((t, k) => t?.[k] ?? value, array);
}
