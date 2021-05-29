import axios from "axios";

export async function doRegister({ name, email, password }) {
    const response = await axios.post("/api/user/register", {
        name,
        email,
        password
    });
    console.log(response);
    if (response.data.Erro) {
        return {
            message: response.data.Erro
        };
    }
    return {
        sucess: response.data.sucess,
        token: response.data.token,
        user: response.data.user
    };
}
