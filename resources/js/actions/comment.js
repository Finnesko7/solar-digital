
export const updateComment = async (id, message) => {
    let response =  await fetch(`/api/comment/${id}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify({
            message
        })
    });

    return response.json();
}

export const createComment = async (comment) => {
    let response = await fetch(`/api/comment`, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        },
        body: JSON.stringify(comment)
    });

    return  response.json();
}


