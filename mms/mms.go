package main
import "fmt"
import "os"

// #cgo CFLAGS: -I/usr/local/include/libmms
// #cgo LDFLAGS: -L/usr/local/lib/ -lmms
// #include <string.h>
// #include <stdio.h>
// #include <stdlib.h>
// #include "mms.h"
import "C"
import "unsafe"

func main() {
    var MmsAddress string = "mms://live.cri.cn/pop";
    var fileOutput string = "out.file";
    fo, err := os.Create(fileOutput)
    if err != nil {
        panic(err)
    }
    defer func() {
        if err := fo.Close; err != nil {
            panic(err)
        }
    }()
    Cstr := C.CString(MmsAddress);
    defer C.free(unsafe.Pointer(Cstr));
    Conn := C.mms_connect(nil, nil, Cstr, 1); 
    if Conn != nil {
        fmt.Printf("connect ok\n");        
    }
    // save fetch data
    var i int = 0;
    buf := make([]byte,1024);
    for ; i < 1000; i++ {
        res,err := C.mms_read(nil, Conn, (*C.char)(unsafe.Pointer(&buf[0])), 1024)
        if err != nil {
            break;
        }
        // parse c int res to go 
        resIngo := int(res);
        if resIngo == 0 {
            // nothing read
            break;
        }
        if _, err := fo.Write(buf[:resIngo]); err != nil {
            panic(err)
        }
    }
}
