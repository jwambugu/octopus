export const errorHandler = (error) => {
    switch (error.response.status) {
        case 422: {
            const key = Object.keys(error.response.data.errors)[0];

            return error.response.data.errors[key][0];
        }
        default: {
            return "Something went wrong. Please try again.";
        }
    }
};
