<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Listado Seguimiento ART">
                <vue-good-table
                    :columns="columns"
                    :rows="listadoART"
                    :search-options="{
                        enabled: true
                    }"
                    :pagination-options="{
                        enabled: true,
                        perPage: pageLength
                    }"
                >
                    <template slot="table-row" slot-scope="props">
                        <!-- Column: Name -->
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                        </span>

                        <!-- Column: Action -->
                        <span v-else-if="props.column.field === 'action'">
                            <info-icon
                                size="1.5x"
                                class="custom-class"
                                @click="
                                    ControlGArt(
                                        props.row.id,
                                        props.row.idLicitacion,
                                        props.row.idSegART,
                                        props.row.idTipoMantencion
                                    )
                                "
                            ></info-icon>
                            <upload-icon
                                size="1.5x"
                                class="custom-class"
                                @click="informacionART(props.row.id)"
                            ></upload-icon>
                            <plus-circle-icon
                                size="1.5x"
                                class="custom-class"
                                @click="agregarNuevoDocumento(props.row.idART)"
                            ></plus-circle-icon>
                            <info-icon
                                size="1.5x"
                                class="custom-class"
                                @click="informacionGeneral(props.row.idART)"
                            ></info-icon>
                            <trash-2-icon
                                size="1.5x"
                                class="custom-class"
                                @click="quitarItem(props.row.id)"
                            ></trash-2-icon>
                        </span>

                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </vx-card>
            <vs-popup
                classContent="popGuardarDoc"
                title="Subir Documento"
                :active.sync="popGuardarDoc"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card>
                                <div class="vx-row mb-12">
                                    <div class="vx-col w-full mt-5">
                                        <vs-input
                                            type="file"
                                            @change="getImage"
                                            class="form-control w-full"
                                        />
                                    </div>
                                </div>
                            </vx-card>
                            <br />
                            <vx-card>
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        color="danger"
                                        type="filled"
                                        class="w-full"
                                        @click="uploadImage"
                                        >Guardar Documento</vs-button
                                    >
                                </div>
                                <br />
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        @click="popGuardarDoc = false"
                                        color="primary"
                                        class="w-full"
                                        type="filled"
                                        >Volver</vs-button
                                    >
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
            <vs-popup
                classContent="popVerDoc"
                title="Ver Documentos"
                :active.sync="popVerDoc"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card>
                                <vue-good-table
                                    :columns="col"
                                    :rows="listadoRegistroDocumentos"
                                    :search-options="{
                                        enabled: true
                                    }"
                                    :pagination-options="{
                                        enabled: true,
                                        perPage: pageLength
                                    }"
                                >
                                    <template
                                        slot="table-row"
                                        slot-scope="props"
                                    >
                                        <!-- Column: Name -->
                                        <span
                                            v-if="
                                                props.column.field ===
                                                    'fullName'
                                            "
                                            class="text-nowrap"
                                        >
                                        </span>

                                        <!-- Column: Action -->
                                        <span
                                            v-else-if="
                                                props.column.field === 'action'
                                            "
                                        >
                                            <plus-circle-icon
                                                size="1.5x"
                                                class="custom-class"
                                                @click="
                                                    verDoc(
                                                        props.row
                                                            .nombreDocumento
                                                    )
                                                "
                                            ></plus-circle-icon>
                                            <trash-2-icon
                                                size="1.5x"
                                                class="custom-class"
                                                @click="
                                                    popConfirmacionEliminacionDocumento(
                                                        props.row.id
                                                    )
                                                "
                                            ></trash-2-icon>
                                        </span>

                                        <!-- Column: Common -->
                                        <span v-else>
                                            {{
                                                props.formattedRow[
                                                    props.column.field
                                                ]
                                            }}
                                        </span>
                                    </template>
                                </vue-good-table>
                            </vx-card>
                            <br />
                            <vx-card>
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        @click="popVerDoc = false"
                                        color="primary"
                                        class="w-full"
                                        type="filled"
                                        >Volver</vs-button
                                    >
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
            <vs-popup
                classContent="popDeleteDoc"
                title="Realmente desea eliminar este documento?"
                :active.sync="popDeleteDoc"
            >
                <div class="vx-col w-full mb-base">
                    <div class="vx-row mb-4">
                        <vx-card title="">
                            <div class="vx-row mb-4">
                                <div class="vx-col w-1/2 mt-5">
                                    <vs-button
                                        class="w-full"
                                        color="primary"
                                        @click="
                                            (popDeleteDoc = false),
                                                (popVerDoc = true)
                                        "
                                        >Volver</vs-button
                                    >
                                </div>
                                <br />
                                <div class="vx-col w-1/2 mt-5">
                                    <vs-button
                                        class="w-full"
                                        color="warning"
                                        @click="deleteDocumento()"
                                        >Eliminar Documento</vs-button
                                    >
                                </div>
                            </div>
                        </vx-card>
                    </div>
                </div>
            </vs-popup>
        </div>
    </vs-row>
</template>
<script>
import axios from "axios";
import router from "@/router";
import { InfoIcon } from "vue-feather-icons";
import { PlusCircleIcon } from "vue-feather-icons";
import { Trash2Icon } from "vue-feather-icons";
import { UploadIcon } from "vue-feather-icons";
import { CornerDownRightIcon } from "vue-feather-icons";
import { ArchiveIcon } from "vue-feather-icons";
import { UploadCloudIcon } from "vue-feather-icons";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import Vue from "vue";
import Vuesax from "vuesax";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
import VueGoodTablePlugin from "vue-good-table";
import { validate, clean, format } from "rut.js";

// import the styles
import "vue-good-table/dist/vue-good-table.css";

Vue.use(VueGoodTablePlugin);

export default {
    components: {
        ArchiveIcon,
        InfoIcon,
        PlusCircleIcon,
        Trash2Icon,
        UploadIcon,
        CornerDownRightIcon,
        flatPickr,
        "v-select": vSelect,
        quillEditor,
        UploadCloudIcon
    },
    data() {
        return {
            pageLength: 10,
            dir: false,
            searchTerm: "",
            popGuardarDoc: false,
            popVerDoc: false,
            popDeleteDoc: false,
            fileName: "",
            image: "",
            idART: 0,
            idDelDoc: 0,
            desDoc: "",
            listadoART: [],
            listadoRegistroDocumentos: [],
            editorOption: {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        ["blockquote", "code-block"],
                        [{ header: 1 }, { header: 2 }],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ indent: "-1" }, { indent: "+1" }],
                        [{ direction: "rtl" }],
                        [{ font: [] }],
                        [{ align: [] }],
                        ["clean"]
                    ]
                }
            },
            columns: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idART"
                },
                {
                    label: "Rut Proveedor",
                    field: "rutProveedor"
                },
                {
                    label: "Descripcion Proveedor",
                    field: "descripcionProveedor"
                },
                {
                    label: "Monto",
                    field: "monto",
                    type: "number"
                },

                {
                    label: "N° Factura",
                    field: "nfactura",
                    type: "number"
                },
                {
                    label: "Solicitante",
                    field: "descripcionSolicitante"
                },
                {
                    label: "Detalle ART",
                    field: "detalleART"
                },
                {
                    label: "Fecha Emision ART",
                    field: "fechaART",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Fecha Factura ART",
                    field: "fechaFactura",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Fecha Ultima Actualizacion",
                    field: "updated_at",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Opciones",
                    field: "action"
                }
            ],
            col: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idART",
                    type: "number"
                },
                {
                    label: "Descripcion Documento",
                    field: "descripcionDocumento"
                },
                {
                    label: "Documentos",
                    field: "action"
                }
            ],
            popModificarART: false,
            CconfirmarModificar: false,
            localVal: process.env.MIX_APP_URL,
            urlDocumentos: process.env.MIX_APP_URL_DOCUMENTOS
        };
    },
    methods: {
        //Funciones
        informacionART(id) {
            try {
                this.$router.push({
                    name: "ModificarART",
                    params: {
                        id: `${id}`
                    }
                });
            } catch (error) {
                console.log("Hubo un error al tratar de dirigirse al sitio");
            }
        },
        agregarNuevoDocumento(id) {
            this.popGuardarDoc = true;
            this.idART = id;
        },
        verDoc(doc) {
            const url = this.urlDocumentos + doc;
            window.open(url, "_blank");
        },
        popConfirmacionEliminacionDocumento(id) {
            this.popDeleteDoc = true;
            this.popVerDoc = false;
            this.idDelDoc = id;
        },
        //Funciones
        ControlGArt(id, idLic, idSegART, idTipoMantencion) {
            try {
                if (idSegART === null) {
                    this.$router.push({
                        name: "ControlGastoART",
                        params: {
                            id: `${id}`,
                            idLic: `${idLic}`,
                            idSegART: `${id}`,
                            idTipoMantencion: `${idTipoMantencion}`
                        }
                    });
                } else {
                    this.$router.push({
                        name: "ControlGastoART",
                        params: {
                            id: `${id}`,
                            idLic: `${idLic}`,
                            idSegART: `${idSegART}`,
                            idTipoMantencion: `${idTipoMantencion}`
                        }
                    });
                }
            } catch (error) {
                console.log("Hubo un error al tratar de dirigirse al sitio");
                console.log(error);
            }
        },
        quitarItem(id) {
            try {
            } catch (error) {
                console.log("Hubo un error al capturar el dato");
            }
        },
        getImage(event) {
            //Asignamos la imagen a  nuestra data
            this.image = event.target.files[0];
            this.desDoc = this.image.name;
        },
        uploadImage() {
            //Creamos el formData
            var data = new FormData();
            //Añadimos la imagen seleccionada
            data.append("avatar", this.image);
            data.append("id", this.idART);
            data.append("nombreDoc", this.desDoc);
            axios
                .post(this.localVal + "/api/ART/PostDocumentoF", data, {
                    headers: {
                        Authorization:
                            `Bearer ` + sessionStorage.getItem("token")
                    }
                })
                .then(response => {
                    let resp = response.data;
                    if (resp == true) {
                        this.$vs.notify({
                            title: "Documento Guardado ",
                            text:
                                "Podra Visualizarlo en el menu del costado para descargarlo o visualizarlo en el navegador ",
                            color: "success",
                            position: "top-right"
                        });
                        this.popGuardarDoc = false;
                    } else {
                        this.$vs.notify({
                            title: "Error al subir el documento ",
                            text:
                                "Intente nuevamente con el formato PDF o alguna Imagen ",
                            color: "danger",
                            position: "top-right"
                        });
                    }
                });
        },
        informacionGeneral(id) {
            try {
                this.popVerDoc = true;
                let objeto = {
                    idART: id
                };
                axios
                    .post(
                        this.localVal + "/api/ART/GetRegistroDocumentosF",
                        objeto,
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        this.listadoRegistroDocumentos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        deleteDocumento() {
            try {
                let objeto = {
                    id: this.idDelDoc
                };
                axios
                    .post(this.localVal + "/api/ART/DestroyDocRegART", objeto, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                title: "Realizado ",
                                text: "Documento Eliminado Correctamente ",
                                color: "success",
                                position: "top-right"
                            });
                            this.popDeleteDoc = false;
                        } else {
                            this.$vs.notify({
                                title: "Error ",
                                text: "No fue posible eliminar el documento ",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    });
            } catch (error) {
                this.$vs.notify({
                    title: "Error ",
                    text:
                        "Hubo un problema al tratar de eliminar el documento ",
                    color: "danger",
                    position: "top-right"
                });
            }
        },
        //Carga Data
        cargarRegistros() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetRegistroART", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let c = JSON.parse(JSON.stringify(res.data));
                        let b = [];
                        const formatter = new Intl.NumberFormat("en-US", {
                            style: "currency",
                            currency: "USD",
                            minimumFractionDigits: 0
                        });

                        c.forEach((value, index) => {
                            value.monto = formatter.format(value.monto);
                            b.push(value);
                        });
                        this.listadoART = b;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },

    created() {
        this.cargarRegistros();
    }
};
</script>
