import React from "react";
import {getTasks} from "../../../ultis";

function SelectProject({projectId, projects, setProjectId, setTasks}) {
    const selectProject = (e) => {
        const value = e.target.value;
        setProjectId(value);
        if (value === '') {
            setTasks([]);
        } else {
            getTasks(value).then((tasksData) => setTasks(tasksData));
        }
    };

    return (
        <div className="projects">
            <select className="projects-select"
                    value={projectId}
                    onChange={selectProject}>
                <option value="" selected>Choose a project</option>
                {projects.map((project) => (
                    <option key={project.id}
                            value={project.id}>{project.name}</option>
                ))}
            </select>
        </div>
    );
}

export default SelectProject;