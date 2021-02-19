<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Llenar formulario con datos existentes">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° ART Existente:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° OC Existente:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            taggable
                            label="descripcionOrdenCompras"
                            v-model="seleccionOrdenCompraForAPI"
                            :options="listadoOrdenComprasData"
                            @input="cargarAPIByOC"
                        ></v-select>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/3 mt-5">
                        <h6>N° ART:</h6>
                        <br />
                        <vs-input class="inputx w-full"> </vs-input>
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha ART</h6>
                        <br />
                        <flat-pickr
                            :config="configFromdateTimePicker"
                            v-model="fechaART"
                            placeholder="Fecha ART"
                            @on-change="onFromChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha Factura</h6>
                        <br />
                        <flat-pickr
                            :config="configTodateTimePicker"
                            v-model="fechaFactura"
                            placeholder="Fecha Factura"
                            @on-change="onToChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Rut Proveedor</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            v-model="seleccionProveedores"
                            label="rutProveedor"
                            :options="listadoProveedores"
                            @on-change="seleccionDescripcionProveedor"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Proveedor:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="seleccionProveedores.descripcionProveedor"
                            readonly
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Solicitante:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionSolicitante"
                            v-model="seleccionSolicitantes"
                            :options="listadoSolicitantes"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Ejecutor:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionEjecutores"
                            v-model="seleccionEjecutor"
                            :options="listadoEjecutores"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Item Presupuestario:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="codigoItemPresupuestario"
                            v-model="seleccionItemPresupuestario"
                            :options="listadoItemPresupuestario"
                            @on-change="selecciondescripcionIP"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Item Presupuestario:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            readonly
                            v-model="
                                seleccionItemPresupuestario.descripcionItemPresupuestario
                            "
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Mantencion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionTipoMantencion"
                            v-model="seleccionTipoMantencion"
                            :options="listadoTipoMantencion"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Recurso:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionRecursos"
                            v-model="seleccionRecursos"
                            :options="listadoRecursos"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Compra:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionTipoCompra"
                            v-model="seleccionTipoCompra"
                            :options="listadoTipoCompra"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Licitacion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="codigoLicitacion"
                            v-model="seleccionLicitaciones"
                            :options="listadoLicitaciones"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Llamados:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResLlamados"
                            v-model="seleccionResolucionLlamado"
                            :options="listadoResolucionLlamados"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Adjudicacion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResAdj"
                            v-model="seleccionResolucionAdjudicaciones"
                            :options="listadoResolucionAdjudicaciones"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Contrato:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResContratos"
                            v-model="seleccionResolucionContrato"
                            :options="listadoResolucionContrato"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° CDP:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionCDPS"
                            v-model="seleccionCDP"
                            :options="listadoCDP"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Orden de Compra:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionOrdenCompras"
                            v-model="seleccionOrdenCompra"
                            :options="listadoOrdenCompras"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Interna:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResInternas"
                            v-model="seleccionResolucionInterna"
                            :options="listadoResolucionInterna"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>N° Memo</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionMemo"
                            v-model="seleccionMemo"
                            :options="listadoMemos"
                            taggable
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Monto:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="montoART"
                            @blur="convertirMonto"
                            @focus="retornarMonto"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Cuota:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="cuotaART"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Saldo:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="saldoART"
                            @blur="convertirSaldo"
                            @focus="retornarSaldo"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Factura:</h6>
                        <br />
                        <vs-input class="inputx w-full" v-model="nfacturaART">
                        </vs-input>
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>Detalle ART</h6>
                        <br />
                        <quill-editor
                            class="w-full"
                            v-model="descripcionART"
                            :options="editorOption"
                        >
                            <div id="toolbar" slot="toolbar"></div>
                        </quill-editor>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button class="fixedHeight w-full" color="primary"
                            >Volver</vs-button
                        >
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button class="fixedHeight w-full" color="success"
                            >Guardar</vs-button
                        >
                    </div>
                </div>
            </vx-card>
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
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import Vue from "vue";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
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
        quillEditor
    },

    data() {
        return {
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
            fechaART: new Date(),
            fechaFactura: new Date(),
            configFromdateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configTodateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configdateTimePicker: {
                enableTime: true,
                enableSeconds: true,
                noCalendar: false
            },
            listadoCDP: [],
            listadoEjecutores: [],
            listadoItemPresupuestario: [],
            listadoLicitaciones: [],
            listadoMemos: [],
            listadoOrdenCompras: [],
            listadoOrdenComprasData: [],
            listadoProveedores: [],
            listadoRecursos: [],
            listadoResolucionAdjudicaciones: [],
            listadoResolucionContrato: [],
            listadoResolucionInterna: [],
            listadoResolucionLlamados: [],
            listadoSolicitantes: [],
            listadoTipoCompra: [],
            listadoTipoMantencion: [],
            seleccionCDP: {
                id: 0,
                descripcionCDPS: ""
            },
            seleccionEjecutor: {
                id: 0,
                descripcionEjecutores: ""
            },
            seleccionItemPresupuestario: {
                id: 0,
                codigoItemPresupuestario: "",
                descripcionItemPresupuestario: ""
            },
            seleccionLicitaciones: {
                id: 0,
                codigoLicitacion: ""
            },
            seleccionMemo: {
                id: 0,
                descripcionMemo: ""
            },
            seleccionOrdenCompra: {
                id: 0,
                descripcionOrdenCompras: "",
                fecha_oc: new Date(),
                idEstadoOC: 0
            },
            seleccionOrdenCompraForAPI: {
                id: 0,
                descripcionOrdenCompras: "",
                fecha_oc: new Date(),
                idEstadoOC: 0
            },
            seleccionProveedores: {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            },
            seleccionRecursos: {
                id: 0,
                descripcionRecursos: ""
            },
            seleccionResolucionAdjudicaciones: {
                id: 0,
                descripcionResAdj: ""
            },
            seleccionResolucionContrato: {
                id: 0,
                descripcionResContratos: ""
            },
            seleccionResolucionInterna: {
                id: 0,
                descripcionResInternas: ""
            },
            seleccionResolucionLlamado: {
                id: 0,
                descripcionResLlamados: ""
            },
            seleccionSolicitantes: {
                id: 0,
                descripcionSolicitante: ""
            },
            seleccionTipoCompra: {
                id: 0,
                descripcionTipoCompra: ""
            },
            seleccionTipoMantencion: {
                id: 0,
                descripcionTipoMantencion: ""
            },
            descripcionART: "",
            montoART: 0,
            montoData: 0,
            cuotaART: 0,
            saldoART: 0,
            saldoData: 0,
            nfacturaART: 0,
            localVal: process.env.MIX_APP_URL
        };
    },
    methods: {
        isNumber: function(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (
                charCode > 31 &&
                (charCode < 48 || charCode > 57) &&
                charCode !== 46
            ) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        convertirMonto() {
            try {
                const formatter = new Intl.NumberFormat("en-US", {
                    style: "currency",
                    currency: "USD",
                    minimumFractionDigits: 0
                });

                this.montoData = this.montoART;
                this.montoART = formatter.format(this.montoData);
            } catch (error) {
                console.log(error);
            }
        },
        retornarMonto() {
            try {
                this.montoART = this.montoData;
            } catch (error) {
                console.log(error);
            }
        },
        convertirSaldo() {
            try {
                const formatter = new Intl.NumberFormat("en-US", {
                    style: "currency",
                    currency: "USD",
                    minimumFractionDigits: 0
                });
                this.saldoData = this.saldoART;
                this.saldoART = formatter.format(this.saldoData);
            } catch (error) {
                console.log(error);
            }
        },
        retornarSaldo() {
            try {
                this.saldoART = this.saldoData;
            } catch (error) {
                console.log(error);
            }
        },
        limpiar() {},
        onFromChange(selectedDates, dateStr, instance) {
            this.$set(this.configTodateTimePicker, dateStr);
        },
        onToChange(selectedDates, dateStr, instance) {
            this.$set(this.configFromdateTimePicker, dateStr);
        },
        cargarAPIByOC() {
            try {
                let id = this.seleccionOrdenCompraForAPI
                    .descripcionOrdenCompras;
                axios
                    .all([
                        axios.get(
                            this.localVal + `/api/ART/GetDataByOC/${id}`,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        ),
                        axios.get(
                            "http://api.mercadopublico.cl/servicios/v1/publico/ordenesdecompra.json?codigo=" +
                                id +
                                "&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844",
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                    ])
                    .then(
                        axios.spread((res1, res2) => {
                            const formatter = new Intl.NumberFormat("en-US", {
                                style: "currency",
                                currency: "USD",
                                minimumFractionDigits: 0
                            });
                            let lista = res1.data;
                            let count = lista.length;
                            if (count > 1) {
                                console.log(lista);
                            } else {
                                let list = res2.data;
                                console.log(list);
                                this.descripcionART =
                                    list.Listado[0].Items.Listado[0].EspecificacionProveedor;
                                let monto = list.Listado[0].Total;
                                let cantidad =
                                    list.Listado[0].Items.Listado[0].Cantidad;
                                if (cantidad == 1) {
                                    this.montoData = monto;
                                    this.montoART = formatter.format(
                                        this.montoData
                                    );
                                } else if (cantidad > 1) {
                                    let valorCalculado = monto / cantidad;
                                    valorCalculado = Math.round(valorCalculado);
                                    this.montoData = valorCalculado;
                                    this.montoART = formatter.format(
                                        this.montoData
                                    );
                                }

                                let idOC = list.Listado[0].Codigo;
                                let listOC = JSON.parse(
                                    JSON.stringify(this.listadoOrdenCompras)
                                );

                                listOC.forEach((value, index) => {
                                    if (idOC == value.descripcionOrdenCompras) {
                                        this.seleccionOrdenCompra.id = value.id;
                                        this.seleccionOrdenCompra.descripcionOrdenCompras =
                                            value.descripcionOrdenCompras;
                                    }
                                });

                                let listProv = JSON.parse(
                                    JSON.stringify(this.listadoProveedores)
                                );
                                let rutProv =
                                    list.Listado[0].Proveedor.RutSucursal;
                                listProv.forEach((value, index) => {
                                    if (rutProv == value.rutProveedor) {
                                        this.seleccionProveedores.id = value.id;
                                        this.seleccionProveedores.rutProveedor =
                                            value.rutProveedor;
                                        this.seleccionProveedores.descripcionProveedor =
                                            value.descripcionProveedor;
                                    }
                                });

                                let codigoIP = list.Listado[0].Financiamiento;
                                let listIP = JSON.parse(
                                    JSON.stringify(
                                        this.listadoItemPresupuestario
                                    )
                                );
                                listIP.forEach((value, index) => {
                                    if (
                                        codigoIP ==
                                        value.codigoItemPresupuestario
                                    ) {
                                        this.seleccionItemPresupuestario.id =
                                            value.id;
                                        this.seleccionItemPresupuestario.codigoItemPresupuestario =
                                            value.codigoItemPresupuestario;
                                        this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                                            value.descripcionItemPresupuestario;
                                    }
                                });

                                let codLic = list.Listado[0].CodigoLicitacion;
                                let contador = codLic.length;
                                if (contador > 1) {
                                    let listLic = JSON.parse(
                                        JSON.stringify(this.listadoLicitaciones)
                                    );
                                    listLic.forEach((value, index) => {
                                        if (codLic == value.codigoLicitacion) {
                                            this.seleccionLicitaciones.id =
                                                value.id;
                                            this.seleccionLicitaciones.codigoLicitacion =
                                                value.codigoLicitacion;
                                        }
                                    });
                                    this.cargarByIDLicitacion(codLic);
                                }
                            }
                        })
                    )
                    .catch(error => {
                        // Error 😨
                        if (error.response) {
                            /*
                             * The request was made and the server responded with a
                             * status code that falls out of the range of 2xx
                             */
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            /*
                             * The request was made but no response was received, `error.request`
                             * is an instance of XMLHttpRequest in the browser and an instance
                             * of http.ClientRequest in Node.js
                             */
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request and triggered an Error
                            console.log("Error", error.message);
                        }
                        console.log(error.config);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarByIDLicitacion(codLicitacion) {
            try {
                axios
                    .get(
                        "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo=" +
                            codLicitacion +
                            "&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844",
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        let list = res.data;
                        let tipoOC = list.Listado[0].Tipo;
                        let listOC = JSON.parse(
                            JSON.stringify(this.listadoTipoCompra)
                        );
                        listOC.forEach((value, index) => {
                            if (tipoOC == value.descripcionTipoCompra) {
                                this.seleccionTipoCompra.id = value.id;
                                this.seleccionTipoCompra.descripcionTipoCompra =
                                    value.descripcionTipoCompra;
                            }
                        });

                        let listResAdj = JSON.parse(
                            JSON.stringify(this.listadoResolucionAdjudicaciones)
                        );
                        let nresadj = list.Listado[0].Adjudicacion.Numero;

                        listResAdj.forEach((value, index) => {
                            if (nresadj == value.descripcionResAdj) {
                                this.seleccionResolucionAdjudicaciones.id =
                                    value.id;
                                this.seleccionResolucionAdjudicaciones.descripcionResAdj =
                                    value.descripcionResAdj;
                            }
                        });

                        let presupuesto =
                            list.Listado[0].Items.Listado[0].Adjudicacion
                                .MontoUnitario;
                        if (
                            presupuesto == null ||
                            presupuesto === 0 ||
                            presupuesto == ""
                        ) {
                            console.log("No hay datos de presupuesto");
                        } else {
                            let tasa = 19;
                            let iva = (presupuesto * tasa) / 100;
                            let total = presupuesto + iva;
                            total = Math.round(total);
                        }
                    })
                    .catch(error => {
                        // Error 😨
                        if (error.response) {
                            /*
                             * The request was made and the server responded with a
                             * status code that falls out of the range of 2xx
                             */
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            /*
                             * The request was made but no response was received, `error.request`
                             * is an instance of XMLHttpRequest in the browser and an instance
                             * of http.ClientRequest in Node.js
                             */
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request and triggered an Error
                            console.log("Error", error.message);
                        }
                        console.log(error.config);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        seleccionDescripcionProveedor() {
            try {
                let list = JSON.parse(JSON.stringify(this.listadoProveedores));
                let a = this.seleccionProveedores.rutProveedor;
                list.forEach((value, index) => {
                    if (a == value.rutProveedor) {
                        this.seleccionProveedores.descripcionProveedor =
                            value.descripcionProveedor;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        selecciondescripcionIP() {
            try {
                let list = JSON.parse(
                    JSON.stringify(this.listadoItemPresupuestario)
                );
                let a = this.seleccionItemPresupuestario
                    .codigoItemPresupuestario;
                list.forEach((value, index) => {
                    if (a == value.codigoItemPresupuestario) {
                        this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                            value.descripcionItemPresupuestario;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        cargarCDP() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetCDP", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoCDP = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarEjecutores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetEjecutores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoEjecutores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarItemPresupuestario() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetItemPresupuestario", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoItemPresupuestario = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarLicitaciones() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetLicitaciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoLicitaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarMemos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetMemos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoMemos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarOrdenCompras() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetOrdenCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoOrdenCompras = res.data;
                        this.listadoOrdenComprasData = JSON.parse(
                            JSON.stringify(this.listadoOrdenCompras)
                        );
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarProveedores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetProveedores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoProveedores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarRecursos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetRecursos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoRecursos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionAdjudicaciones() {
            try {
                axios
                    .get(
                        this.localVal + "/api/ART/GetResolucionAdjudicaciones",
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        this.listadoResolucionAdjudicaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionContrato() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionContratos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionContrato = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionInterna() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionInternas", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionInterna = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionLlamado() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionLlamados", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionLlamados = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarSolicitantes() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetSolicitantes", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoSolicitantes = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoCompra() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoCompra = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoMantencion() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoMantenciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoMantencion = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created: function() {
        this.cargarCDP();
        this.cargarEjecutores();
        this.cargarItemPresupuestario();
        this.cargarLicitaciones();
        this.cargarMemos();
        this.cargarOrdenCompras();
        this.cargarProveedores();
        this.cargarRecursos();
        this.cargarResolucionAdjudicaciones();
        this.cargarResolucionContrato();
        this.cargarResolucionInterna();
        this.cargarResolucionLlamado();
        this.cargarSolicitantes();
        this.cargarTipoCompra();
        this.cargarTipoMantencion();
        this.convertirMonto();
        this.convertirSaldo();
    }
};
</script>
