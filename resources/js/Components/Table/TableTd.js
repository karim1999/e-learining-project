import React from "react";

export default function ({children}){
    return (
        <td className="px-6 py-4 whitespace-nowrap">
            <div className="flex items-center">
                <div className="">
                    <div className="text-sm font-medium text-gray-900">
                        {children}
                    </div>
                </div>
            </div>
        </td>
    )
}
