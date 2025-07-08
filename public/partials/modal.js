let components = document.querySelectorAll(".component");
let modalContainer = document.querySelector(".modal-container");
function modal(data, action) {
    modalContainer.classList.add("show");
    components.forEach((el) => {
        el.classList.add("hide");
    });

    if (action === "admin-child-edit") {
        document
            .querySelector(".admin-child-edit")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-child-edit form")
            .setAttribute("action", `/admin/children/${data.id}`, data.id);
        document.querySelector(
            ".admin-child-edit #admin-child-edit-name"
        ).value = data.name;
        document.querySelector(
            ".admin-child-edit #admin-child-edit-male"
        ).checked = data.gender === "male";
        document.querySelector(
            ".admin-child-edit #admin-child-edit-female"
        ).checked = data.gender === "female";
        document.querySelector(
            ".admin-child-edit #admin-child-edit-other"
        ).checked = data.gender === "other";
        document.querySelector(
            ".admin-child-edit #admin-child-edit-dob"
        ).value = data.dob;
    }

    if (action === "admin-child-delete") {
        document
            .querySelector(".admin-child-delete")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-child-delete form")
            .setAttribute("action", `/admin/children/${data.id}`, data.id);
        document.querySelector(
            ".admin-child-delete button"
        ).textContent = `Delete ${data.name}`;
    }
    if (action === "admin-child-add") {
        document
            .querySelector(".admin-child-add")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-child-add form")
            .setAttribute("action", `/admin/children/`);
        document.querySelector(".admin-child-add button").textContent = `Add`;
        document.querySelector(".admin-child-add-parent").innerHTML =
            "<option selected disabled>Select Parent</option>";
        data.forEach((el) => {
            const option = document.createElement("option");
            option.value = el.id;
            option.textContent = el.name;
            document
                .querySelector(".admin-child-add-parent")
                .appendChild(option);
        });
    }
    if (action === "admin-parent-edit") {
        console.dir(data);
        document
            .querySelector(".admin-parent-edit")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-parent-edit form")
            .setAttribute("action", `/admin/parents/${data.id}`, data.id);
        document.querySelector("#admin-parent-edit-name").value = data.name;
        document.querySelector("#admin-parent-edit-email").value = data.email;
        document.querySelector("#admin-parent-edit-phone").value = data.phone;
        document.querySelector("#admin-parent-edit-address").value =
            data.address;
    }
    if (action === "admin-parent-delete") {
        document
            .querySelector(".admin-parent-delete")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-parent-delete form")
            .setAttribute("action", `/admin/parent/${data.id}`, data.id);
        document.querySelector(
            ".admin-parent-delete button"
        ).textContent = `Delete ${data.name}`;
    }
    if (action === "admin-parent-add") {
        document
            .querySelector(".admin-parent-add")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-parent-add form")
            .setAttribute("action", `/admin/parents/`);
        document.querySelector(".admin-parent-add button").textContent = `Add`;
    }
    if (action === "admin-hospital-edit") {
        console.dir(data);
        document
            .querySelector(".admin-hospital-edit")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-hospital-edit form")
            .setAttribute("action", `/admin/hospitals/${data.id}`, data.id);
        document.querySelector("#admin-hospital-edit-name").value = data.name;
        document.querySelector("#admin-hospital-edit-email").value = data.email;
        document.querySelector("#admin-hospital-edit-phone").value = data.phone;
        document.querySelector("#admin-hospital-edit-address").value =
            data.address;
    }
    if (action === "admin-hospital-add") {
        document
            .querySelector(".admin-hospital-add")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-hospital-add form")
            .setAttribute("action", `/admin/hospitals/`);
        document.querySelector(
            ".admin-hospitals-add button"
        ).textContent = `Add`;
    }
    if (action === "admin-hospital-delete") {
        document
            .querySelector(".admin-hospital-delete")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-hospital-delete form")
            .setAttribute("action", `/admin/hospital/${data.id}`, data.id);
        document.querySelector(
            ".admin-hospital-delete button"
        ).textContent = `Delete ${data.name}`;
    }
    if (action === "admin-vaccine-add") {
        document
            .querySelector(".admin-vaccine-add")
            .classList.replace("hide", "show");
    }
    if (action === "admin-vaccine-delete") {
        document
            .querySelector(".admin-vaccine-delete")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-vaccine-delete form")
            .setAttribute("action", `/admin/vaccines/${data.id}`, data.id);
        document.querySelector(
            ".admin-vaccine-delete button"
        ).textContent = `Delete ${data.name}`;
    }
    if (action === "parent-child-add") {
        document
            .querySelector(".parent-child-add")
            .classList.replace("hide", "show");
        document
            .querySelector(".parent-child-add form")
            .setAttribute("action", `/parent/child/`);
    }
    if (action === "parent-child-edit") {
        document
            .querySelector(".parent-child-edit")
            .classList.replace("hide", "show");
        document
            .querySelector(".parent-child-edit form")
            .setAttribute("action", `/parent/child/${data.id}`);
        document.querySelector(
            ".parent-child-edit #parent-child-edit-name"
        ).value = data.name;
        document.querySelector(
            ".parent-child-edit #parent-child-edit-male"
        ).checked = data.gender === "male";
        document.querySelector(
            ".parent-child-edit #parent-child-edit-female"
        ).checked = data.gender === "female";
        document.querySelector(
            ".parent-child-edit #parent-child-edit-other"
        ).checked = data.gender === "other";
        document.querySelector(
            ".parent-child-edit #parent-child-edit-dob"
        ).value = data.dob;
    }
     if (action === "parent-child-delete") {
        document
            .querySelector(".admin-child-delete")
            .classList.replace("hide", "show");
        document
            .querySelector(".admin-child-delete form")
            .setAttribute("action", `/admin/children/${data.id}`, data.id);
        document.querySelector(
            ".admin-child-delete button"
        ).textContent = `Delete ${data.name}`;
    }
}

function modalHide() {
    modalContainer.classList.remove("show");
}
