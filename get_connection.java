public static Connection getConnection() {

    if (DatabaseConnnector.conn == null) {
        initConn();
    } else {
        try {
            DatabaseConnnector.conn.close();          
        } catch (SQLException e) {
            e.printStackTrace();
        }
          initConn();
    }
    return DatabaseConnnector.conn;
}
