import axios from "axios";

export async function doLogin(email, password) {
    const response = await axios.post("/api/user/login", { email, password });
    if (response.data.Erro) {
        return {
            message: response.data.Erro
        };
    }
    return {
        access_token: response.data.access_token,
        user: response.data.user
    };
}
