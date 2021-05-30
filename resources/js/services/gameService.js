import axios from "axios";

async function updateName(game_id, gameName, token) {
    const config = {
        headers: {
            Authorization: "Bearer " + token,
            Accept: "application/json"
        }
    };
    const response = await axios.put(
        `/api/game/updategame/${game_id}`,
        {
            gameName
        },
        config
    );
    return response.data;
}

export { updateName };
