import axios from "axios";

async function getGames(id, token) {
    const config = {
        headers: {
            Authorization: "Bearer " + token,
            Accept: "application/json"
        }
    };
    const response = await axios.get(`api/game/getgames/${id}`, config);

    if (!response.data) {
        return null;
    }

    return response.data;
}
async function addGames({ user_id, name, finished }, token) {
    const config = {
        headers: {
            Authorization: "Bearer " + token,
            Accept: "application/json"
        }
    };
    const response = await axios.post(
        `api/game/addgame`,
        {
            user_id,
            name,
            finished
        },
        config
    );

    if (!response.data) {
        return null;
    }

    return response.data;
}

export { getGames, addGames };
